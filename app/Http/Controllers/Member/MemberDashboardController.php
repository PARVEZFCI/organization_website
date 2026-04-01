<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberDashboardController extends Controller
{
    private function member()
    {
        return Auth::guard('member')->user();
    }

    public function dashboard()
    {
        $member = $this->member();
        $member->load('monthlyPayments');

        $totalPaid = $member->monthlyPayments->where('status', 'paid')->sum('amount');
        $totalDue = $member->monthlyPayments->where('status', 'due')->sum('amount');
        $paidCount = $member->monthlyPayments->where('status', 'paid')->count();
        $dueCount = $member->monthlyPayments->where('status', 'due')->count();
        $membershipFee = $member->amount;

        return view('frontend.member.dashboard', compact(
            'member', 'totalPaid', 'totalDue', 'paidCount', 'dueCount', 'membershipFee'
        ));
    }

    public function payments()
    {
        $member = $this->member();
        $payments = $member->monthlyPayments()->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        $totalPaid = $payments->where('status', 'paid')->sum('amount');
        $totalDue = $payments->where('status', 'due')->sum('amount');

        return view('frontend.member.payments', compact('member', 'payments', 'totalPaid', 'totalDue'));
    }

    public function profile()
    {
        $member = $this->member();
        return view('frontend.member.profile', compact('member'));
    }

    public function updateProfile(Request $request)
    {
        $member = $this->member();

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:50',
            'present_address' => 'nullable|string|max:500',
            'permanent_address' => 'nullable|string|max:500',
            'occupation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'office_address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($member->profile_picture && file_exists(public_path($member->profile_picture))) {
                unlink(public_path($member->profile_picture));
            }
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        $member->update($data);

        return redirect()->route('member.profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $member = $this->member();
        return view('frontend.member.change-password', compact('member'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $member = $this->member();

        if (!Hash::check($request->current_password, $member->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $member->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('member.change-password')->with('success', 'Password changed successfully.');
    }
}
