<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BkashPaymentController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct()
    {
        // bKash Live Credentials
        $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->app_key = 'Oim4ifP3zyRiAneOOOLSsWM9tc';
        $this->app_secret = 'xkHhixJSPwdKvKaiC1hbOnMSmHAcX4O1Vj1cy8N1bIX8PoTeNEv7';
        $this->username = '01841131316';
        $this->password = 'N5+Jcp|1z@7';
    }

    // Get bKash Token
    private function getToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'username' => $this->username,
            'password' => $this->password
        ])->post($this->base_url . '/tokenized/checkout/token/grant', [
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret
        ]);

        return $response->json();
    }

    // Create Payment
    public function createPayment(Request $request)
    {
        $request->validate([
            'donation_fund' => 'required',
            'phone_email' => 'required',
            'amount' => 'required|numeric|min:10'
        ]);

        // Save donation attempt to database immediately
        $donation = Donation::create([
            'donation_fund' => $request->donation_fund,
            'phone_email' => $request->phone_email,
            'amount' => $request->amount,
            'transaction_status' => 'Initiated',
            'bkash_response' => json_encode([
                'status' => 'Payment initiated',
                'time' => now(),
                'ip' => $request->ip()
            ])
        ]);

        // Store donation ID and data in session
        Session::put('donation_id', $donation->id);
        Session::put('donation_data', [
            'donation_fund' => $request->donation_fund,
            'phone_email' => $request->phone_email,
            'amount' => $request->amount
        ]);

        // Get Token
        $tokenData = $this->getToken();

        if (!isset($tokenData['id_token'])) {
            // Update donation with error
            $donation->update([
                'transaction_status' => 'Failed',
                'bkash_response' => json_encode([
                    'error' => 'Failed to get bKash token',
                    'response' => $tokenData,
                    'time' => now()
                ])
            ]);
            return redirect()->back()->with('error', 'Failed to connect with bKash. Please try again.');
        }

        $token = $tokenData['id_token'];
        Session::put('bkash_token', $token);

        // Create Payment
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token,
            'x-app-key' => $this->app_key
        ])->post($this->base_url . '/tokenized/checkout/create', [
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => route('bkash.callback'),
            'amount' => $request->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => 'DYC' . time()
        ]);

        $result = $response->json();

        if (isset($result['bkashURL'])) {
            Session::put('payment_id', $result['paymentID']);

            // Update donation with payment ID
            $donation->update([
                'payment_id' => $result['paymentID'],
                'transaction_status' => 'Pending',
                'bkash_response' => json_encode([
                    'status' => 'Payment URL generated',
                    'paymentID' => $result['paymentID'],
                    'time' => now()
                ])
            ]);

            return redirect($result['bkashURL']);
        }

        // Update donation with error
        $donation->update([
            'transaction_status' => 'Failed',
            'bkash_response' => json_encode([
                'error' => 'Failed to create payment',
                'response' => $result,
                'time' => now()
            ])
        ]);

        return redirect()->back()->with('error', 'Failed to initiate payment. Please try again.');
    }

    // Callback from bKash
    public function callback(Request $request)
    {
        $donationId = Session::get('donation_id');
        $donation = Donation::find($donationId);

        if ($request->status == 'cancel' || $request->status == 'failure') {
            // Update donation status
            if ($donation) {
                $donation->update([
                    'transaction_status' => 'Cancelled',
                    'bkash_response' => json_encode([
                        'status' => $request->status,
                        'message' => 'Payment was cancelled or failed by user',
                        'time' => now()
                    ])
                ]);
            }
            return redirect('/')->with('error', 'Payment was cancelled or failed.');
        }

        if ($request->status == 'success') {
            $token = Session::get('bkash_token');
            $paymentID = $request->paymentID;

            // Execute Payment
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'authorization' => $token,
                'x-app-key' => $this->app_key
            ])->post($this->base_url . '/tokenized/checkout/execute', [
                'paymentID' => $paymentID
            ]);

            $result = $response->json();

            if (isset($result['transactionStatus']) && $result['transactionStatus'] == 'Completed') {
                // Update donation with success
                if ($donation) {
                    $donation->update([
                        'payment_id' => $result['paymentID'],
                        'trx_id' => $result['trxID'],
                        'transaction_status' => 'Completed',
                        'bkash_response' => json_encode($result)
                    ]);
                }

                // Clear session
                Session::forget(['donation_data', 'donation_id', 'bkash_token', 'payment_id']);

                // Redirect to success page with donation details
                return redirect()->route('donation.success', ['id' => $donation->id]);
            } else {
                // Update donation with failure
                if ($donation) {
                    $donation->update([
                        'transaction_status' => 'Failed',
                        'bkash_response' => json_encode([
                            'error' => 'Payment execution failed',
                            'response' => $result,
                            'time' => now()
                        ])
                    ]);
                }
            }
        }

        return redirect('/')->with('error', 'Payment verification failed. Please contact support with your transaction details.');
    }

    // Query Payment
    public function queryPayment($paymentID)
    {
        $token = Session::get('bkash_token');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token,
            'x-app-key' => $this->app_key
        ])->post($this->base_url . '/tokenized/checkout/payment/status', [
            'paymentID' => $paymentID
        ]);

        return $response->json();
    }

    // Success Page
    public function success($id)
    {
        $donation = Donation::findOrFail($id);
        return view('frontend.donation-success', compact('donation'));
    }
}
