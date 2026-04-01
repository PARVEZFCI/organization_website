<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }
        return view('frontend.member.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $member = Membership::where('email', $request->email)->first();

        if (!$member) {
            return back()->withErrors(['email' => 'No member found with this email.'])->withInput();
        }

        if ($member->status !== 'active') {
            return back()->withErrors(['email' => 'Your membership is not yet approved. Please contact admin.'])->withInput();
        }

        if (!$member->password) {
            return back()->withErrors(['email' => 'Your account is not set up for login yet. Please contact admin.'])->withInput();
        }

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('member.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('member.login')->with('success', 'Logged out successfully.');
    }
}
