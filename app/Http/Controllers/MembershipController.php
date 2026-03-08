<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    public function index()
    {
        // Only show active members on the public list
        $memberships = Membership::where('status', 'active')->latest()->paginate(12);
        return view('frontend.memberships-list', compact('memberships'));
    }

    public function create()
    {
        $fees = \App\Models\MembershipFeeSetting::all()->pluck('fee','name');
        return view('frontend.membership', compact('fees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'nid_passport_no' => 'nullable|string|max:50',
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
            'status' => 'nullable|string|in:active,inactive',
        ]);

        // Default status to active if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        // Calculate amount based on payment type using fee settings
        $fees = \App\Models\MembershipFeeSetting::all()->pluck('fee','name');
        switch ($request->payment_type) {
            case 'membership_fee':
                // fee depends on membership_type selection
                $type = $request->membership_type;
                $data['amount'] = $fees[$type] ?? 0;
                break;
            case 'lifetime':
                $data['amount'] = $fees['Life'] ?? 0;
                break;
            case 'monthly_gm':
                // monthly fees not handled dynamically yet, fallback
                $data['amount'] = 100;
                break;
            case 'monthly_ec':
                $data['amount'] = 300;
                break;
            case 'event_fee':
            case 'donation':
                $data['amount'] = $request->custom_amount ?? 0;
                break;
            default:
                $data['amount'] = 0;
        }

        $membership = Membership::create($data);

        // TODO: If payment_method == 'bkash', integrate bKash flow here.

        return redirect()->route('membership.form')->with('success', 'Your membership application has been submitted successfully. We will contact you soon.');
    }
}
