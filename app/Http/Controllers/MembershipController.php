<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    public function create()
    {
        return view('frontend.membership');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',

            'course_name' => 'nullable|string|max:255',
            'intake_no' => 'nullable|string|max:100',
            'passing_year' => 'nullable|integer|min:1900|max:' . (date('Y')+1),

            'mobile' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'office_address' => 'nullable|string',

            'membership_type' => 'required|string|in:General,Life,Associate',
            'payment_type' => 'required|string|in:membership_fee,monthly_gm,monthly_ec,lifetime,event_fee,donation',
            'custom_amount' => 'nullable|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('members', 'public');
            $data['profile_picture'] = $path;
        }

        // Calculate amount based on payment type
        $paymentAmounts = [
            'membership_fee' => 500,
            'monthly_gm' => 100,
            'monthly_ec' => 300,
            'lifetime' => 10000,
            'event_fee' => $request->custom_amount ?? 0,
            'donation' => $request->custom_amount ?? 0,
        ];

        $data['amount'] = $paymentAmounts[$request->payment_type];

        $membership = Membership::create($data);

        // TODO: If payment_method == 'bkash', integrate bKash flow here.

        return redirect()->route('membership.form')->with('success', 'Your membership application has been submitted successfully. We will contact you soon.');
    }
}
