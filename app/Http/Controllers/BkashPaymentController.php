<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\EventRegistration;
use App\Models\MembershipMonthlyPayment;
use App\Services\EventRegistrationDocumentService;
use App\Services\MonthlyPaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BkashPaymentController extends Controller
{
    private string $baseUrl;
    private ?string $appKey;
    private ?string $appSecret;
    private ?string $username;
    private ?string $password;

    public function __construct(
        private MonthlyPaymentService $monthlyPaymentService,
        private EventRegistrationDocumentService $eventRegistrationDocumentService
    )
    {
        $this->baseUrl = rtrim((string) config('services.bkash.base_url'), '/');
        $this->appKey = config('services.bkash.app_key');
        $this->appSecret = config('services.bkash.app_secret');
        $this->username = config('services.bkash.username');
        $this->password = config('services.bkash.password');
    }

    public function createPayment(Request $request): RedirectResponse
    {
        $request->validate([
            'donation_fund' => 'required|string|max:255',
            'phone_email' => 'required|string|max:255',
            'amount' => 'required|numeric|min:10',
        ]);

        $donation = Donation::create([
            'donation_fund' => $request->donation_fund,
            'phone_email' => $request->phone_email,
            'amount' => $request->amount,
            'transaction_status' => 'Initiated',
            'bkash_response' => json_encode([
                'status' => 'Payment initiated',
                'time' => now()->toDateTimeString(),
                'ip' => $request->ip(),
            ]),
        ]);

        Session::put('donation_id', $donation->id);
        Session::put('donation_data', [
            'donation_fund' => $request->donation_fund,
            'phone_email' => $request->phone_email,
            'amount' => $request->amount,
        ]);

        return $this->startBkashPayment(
            amount: (float) $donation->amount,
            merchantInvoiceNumber: 'DON-' . $donation->id . '-' . now()->timestamp,
            context: [
                'type' => 'donation',
                'donation_id' => $donation->id,
            ],
            fallbackRoute: route('donation.page')
        );
    }

    public function createMembershipPayment(Request $request): RedirectResponse
    {
        $member = Auth::guard('member')->user();

        $payment = MembershipMonthlyPayment::query()
            ->where('id', $request->validate([
                'payment_id' => 'required|exists:membership_monthly_payments,id',
            ])['payment_id'])
            ->where('membership_id', $member->id)
            ->firstOrFail();

        if ($payment->status === 'paid') {
            return redirect()->route('member.payments')->with('info', 'This payment is already completed.');
        }

        return $this->startBkashPayment(
            amount: (float) $payment->amount,
            merchantInvoiceNumber: 'MEM-' . $payment->id . '-' . now()->timestamp,
            context: [
                'type' => 'membership_monthly_payment',
                'membership_payment_id' => $payment->id,
                'member_id' => $member->id,
            ],
            fallbackRoute: route('member.payments')
        );
    }

    public function startEventRegistrationPayment(EventRegistration $registration): RedirectResponse
    {
        return $this->startBkashPayment(
            amount: (float) $registration->total_amount,
            merchantInvoiceNumber: 'EVT-' . $registration->id . '-' . now()->timestamp,
            context: [
                'type' => 'event_registration',
                'event_registration_id' => $registration->id,
                'event_id' => $registration->upcoming_event_id,
            ],
            fallbackRoute: route('events.show', $registration->upcoming_event_id)
        );
    }

    public function callback(Request $request): RedirectResponse
    {
        $context = Session::get('bkash_context');

        if (!$context) {
            return redirect('/')->with('error', 'Payment session expired. Please try again.');
        }

        if (in_array($request->status, ['cancel', 'failure'], true)) {
            $this->handleCancelledPayment($context, $request->all());

            return $this->redirectAfterCallback(
                $context,
                'error',
                'Payment was cancelled or failed.'
            );
        }

        if ($request->status !== 'success') {
            return $this->redirectAfterCallback(
                $context,
                'error',
                'Unexpected payment response received from bKash.'
            );
        }

        $token = Session::get('bkash_token');
        $paymentId = $request->paymentID;

        $result = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token,
            'x-app-key' => $this->appKey,
        ])->post($this->baseUrl . '/tokenized/checkout/execute', [
            'paymentID' => $paymentId,
        ])->json();

        if (($result['transactionStatus'] ?? null) === 'Completed') {
            return $this->handleSuccessfulPayment($context, $result);
        }

        $this->handleFailedExecution($context, $result);

        return $this->redirectAfterCallback(
            $context,
            'error',
            'Payment verification failed. Please contact support with your transaction details.'
        );
    }

    public function queryPayment($paymentID)
    {
        $token = Session::get('bkash_token');

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token,
            'x-app-key' => $this->appKey,
        ])->post($this->baseUrl . '/tokenized/checkout/payment/status', [
            'paymentID' => $paymentID,
        ])->json();
    }

    public function success($id)
    {
        $donation = Donation::findOrFail($id);

        return view('frontend.donation-success', compact('donation'));
    }

    private function startBkashPayment(
        float $amount,
        string $merchantInvoiceNumber,
        array $context,
        string $fallbackRoute
    ): RedirectResponse {
        if (!$this->credentialsConfigured()) {
            return redirect($fallbackRoute)->with(
                'error',
                'bKash configuration is incomplete. Please update your environment settings first.'
            );
        }

        $tokenData = $this->getToken();

        if (!isset($tokenData['id_token'])) {
            $this->persistGatewayFailure($context, [
                'error' => 'Failed to get bKash token',
                'response' => $tokenData,
                'time' => now()->toDateTimeString(),
            ]);

            return redirect($fallbackRoute)->with('error', 'Failed to connect with bKash. Please try again.');
        }

        $token = $tokenData['id_token'];
        Session::put('bkash_token', $token);
        Session::put('bkash_context', $context);

        $result = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token,
            'x-app-key' => $this->appKey,
        ])->post($this->baseUrl . '/tokenized/checkout/create', [
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => route('bkash.callback'),
            'amount' => number_format($amount, 2, '.', ''),
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $merchantInvoiceNumber,
        ])->json();

        if (isset($result['bkashURL'], $result['paymentID'])) {
            Session::put('payment_id', $result['paymentID']);
            $this->persistGatewayPending($context, $result);

            return redirect($result['bkashURL']);
        }

        $this->persistGatewayFailure($context, [
            'error' => 'Failed to create payment',
            'response' => $result,
            'time' => now()->toDateTimeString(),
        ]);

        return redirect($fallbackRoute)->with('error', 'Failed to initiate payment. Please try again.');
    }

    private function getToken(): array
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'username' => $this->username,
            'password' => $this->password,
        ])->post($this->baseUrl . '/tokenized/checkout/token/grant', [
            'app_key' => $this->appKey,
            'app_secret' => $this->appSecret,
        ])->json();
    }

    private function credentialsConfigured(): bool
    {
        return filled($this->baseUrl)
            && filled($this->appKey)
            && filled($this->appSecret)
            && filled($this->username)
            && filled($this->password);
    }

    private function handleSuccessfulPayment(array $context, array $result): RedirectResponse
    {
        if ($context['type'] === 'donation') {
            $donation = Donation::find($context['donation_id'] ?? null);

            if ($donation) {
                $donation->update([
                    'payment_id' => $result['paymentID'] ?? null,
                    'trx_id' => $result['trxID'] ?? null,
                    'transaction_status' => 'Completed',
                    'bkash_response' => json_encode($result),
                ]);
            }

            $this->clearBkashSession();

            return redirect()->route('donation.success', ['id' => $donation?->id]);
        }

        if ($context['type'] === 'membership_monthly_payment') {
            $payment = MembershipMonthlyPayment::find($context['membership_payment_id'] ?? null);

            if ($payment) {
                $this->monthlyPaymentService->markAsPaid(
                    $payment,
                    'bkash',
                    'Paid via member portal',
                    $result['trxID'] ?? null,
                    $result['paymentID'] ?? null,
                    json_encode($result)
                );
            }

            $this->clearBkashSession();

            return redirect()->route('member.payments')->with('success', 'Monthly payment completed successfully.');
        }

        $registration = EventRegistration::find($context['event_registration_id'] ?? null);

        if ($registration) {
            $registration->update([
                'payment_status' => 'paid',
                'registration_status' => 'confirmed',
                'payment_method' => 'bkash',
                'gateway_payment_id' => $result['paymentID'] ?? null,
                'transaction_id' => $result['trxID'] ?? null,
                'gateway_response' => json_encode($result),
                'paid_at' => now(),
            ]);

            $this->eventRegistrationDocumentService->sendConfirmationEmail($registration->fresh());
        }

        $this->clearBkashSession();

        if ($registration) {
            return redirect()
                ->route('events.show', $registration->upcoming_event_id)
                ->with('success', 'Event registration payment completed successfully.');
        }

        return redirect('/')->with('success', 'Event registration payment completed successfully.');
    }

    private function handleCancelledPayment(array $context, array $payload): void
    {
        if ($context['type'] === 'donation') {
            $donation = Donation::find($context['donation_id'] ?? null);

            if ($donation) {
                $donation->update([
                    'transaction_status' => 'Cancelled',
                    'bkash_response' => json_encode($payload),
                ]);
            }
        }

        if ($context['type'] === 'membership_monthly_payment') {
            $payment = MembershipMonthlyPayment::find($context['membership_payment_id'] ?? null);

            if ($payment) {
                $payment->update([
                    'gateway_response' => json_encode($payload),
                ]);
            }
        }

        if ($context['type'] === 'event_registration') {
            $registration = EventRegistration::find($context['event_registration_id'] ?? null);

            if ($registration) {
                $registration->update([
                    'payment_status' => 'cancelled',
                    'gateway_response' => json_encode($payload),
                ]);
            }
        }

        $this->clearBkashSession();
    }

    private function handleFailedExecution(array $context, array $result): void
    {
        if ($context['type'] === 'donation') {
            $donation = Donation::find($context['donation_id'] ?? null);

            if ($donation) {
                $donation->update([
                    'transaction_status' => 'Failed',
                    'bkash_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'membership_monthly_payment') {
            $payment = MembershipMonthlyPayment::find($context['membership_payment_id'] ?? null);

            if ($payment) {
                $payment->update([
                    'gateway_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'event_registration') {
            $registration = EventRegistration::find($context['event_registration_id'] ?? null);

            if ($registration) {
                $registration->update([
                    'payment_status' => 'failed',
                    'gateway_response' => json_encode($result),
                ]);
            }
        }

        $this->clearBkashSession();
    }

    private function persistGatewayPending(array $context, array $result): void
    {
        if ($context['type'] === 'donation') {
            $donation = Donation::find($context['donation_id'] ?? null);

            if ($donation) {
                $donation->update([
                    'payment_id' => $result['paymentID'],
                    'transaction_status' => 'Pending',
                    'bkash_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'membership_monthly_payment') {
            $payment = MembershipMonthlyPayment::find($context['membership_payment_id'] ?? null);

            if ($payment) {
                $payment->update([
                    'gateway_payment_id' => $result['paymentID'],
                    'gateway_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'event_registration') {
            $registration = EventRegistration::find($context['event_registration_id'] ?? null);

            if ($registration) {
                $registration->update([
                    'payment_status' => 'pending',
                    'gateway_payment_id' => $result['paymentID'],
                    'gateway_response' => json_encode($result),
                ]);
            }
        }
    }

    private function persistGatewayFailure(array $context, array $result): void
    {
        if ($context['type'] === 'donation') {
            $donation = Donation::find($context['donation_id'] ?? null);

            if ($donation) {
                $donation->update([
                    'transaction_status' => 'Failed',
                    'bkash_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'membership_monthly_payment') {
            $payment = MembershipMonthlyPayment::find($context['membership_payment_id'] ?? null);

            if ($payment) {
                $payment->update([
                    'gateway_response' => json_encode($result),
                ]);
            }
        }

        if ($context['type'] === 'event_registration') {
            $registration = EventRegistration::find($context['event_registration_id'] ?? null);

            if ($registration) {
                $registration->update([
                    'payment_status' => 'failed',
                    'gateway_response' => json_encode($result),
                ]);
            }
        }
    }

    private function redirectAfterCallback(array $context, string $flashType, string $message): RedirectResponse
    {
        if ($context['type'] === 'membership_monthly_payment') {
            return redirect()->route('member.payments')->with($flashType, $message);
        }

        if ($context['type'] === 'event_registration') {
            if (!empty($context['event_id'])) {
                return redirect()
                    ->route('events.show', $context['event_id'])
                    ->with($flashType, $message);
            }

            return redirect('/')->with($flashType, $message);
        }

        return redirect('/')->with($flashType, $message);
    }

    private function clearBkashSession(): void
    {
        Session::forget([
            'donation_data',
            'donation_id',
            'bkash_token',
            'payment_id',
            'bkash_context',
        ]);
    }
}
