<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        // Only show active members on the public list
        $query = Membership::where('status', 'active');

        // Filter by membership type if provided
        if ($request->has('type') && $request->type != '') {
            $query->where('membership_type', $request->type);
        }

        $memberships = $query->latest()->paginate(12);
        $selectedType = $request->get('type', '');

        return view('frontend.memberships-list', compact('memberships', 'selectedType'));
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
            'payment_type' => 'required|string|in:membership_fee',
            'payment_method' => 'required|string',
        ]);

        // Always set status to inactive — admin must approve
        $data['status'] = 'inactive';

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        // Get membership fee from settings based on selected membership type
        $fees = \App\Models\MembershipFeeSetting::all()->pluck('fee','name');
        $data['amount'] = $fees[$request->membership_type] ?? 0;

        $membership = \App\Models\Membership::create($data);

        // Note: Monthly payments for General Members will be auto-generated
        // when admin approves the membership in the backend

        return redirect()->route('membership.form')->with('success', 'Your membership application has been submitted successfully. We will review and contact you soon.');
    }
}
