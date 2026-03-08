<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class AdminMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::latest()->paginate(15);
        return view('backend.membership.index', compact('memberships'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $membership = Membership::findOrFail($id);
        return view('backend.membership.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $membership = Membership::findOrFail($id);

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'nid_passport_no' => 'nullable|string|max:50',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

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
            'amount' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($membership->profile_picture && file_exists(public_path($membership->profile_picture))) {
                unlink(public_path($membership->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        $membership->update($data);

        return redirect()->route('Admin.membership.index')->with('success', 'Membership updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membership = Membership::findOrFail($id);

        // Delete image if exists
        if ($membership->profile_picture && file_exists(public_path($membership->profile_picture))) {
            unlink(public_path($membership->profile_picture));
        }

        $membership->delete();

        return redirect()->route('Admin.membership.index')->with('success', 'Membership deleted successfully!');
    }
}
