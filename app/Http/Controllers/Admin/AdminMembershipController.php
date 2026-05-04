<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Services\MonthlyPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminMembershipController extends Controller
{
    protected MonthlyPaymentService $paymentService;

    public function __construct(MonthlyPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $membershipTypes = ['General', 'Life', 'Associate', 'Founder'];
        $selectedType = $request->string('membership_type')->toString();

        if (!in_array($selectedType, $membershipTypes, true)) {
            $selectedType = '';
        }

        $memberships = Membership::query()
            ->when($selectedType !== '', function ($query) use ($selectedType) {
                $query->where('membership_type', $selectedType);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('backend.membership.index', compact('memberships', 'membershipTypes', 'selectedType'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('backend.membership.create');
    }

    /**
     * Store a newly created member.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'        => 'required|string|max:255',
            'nid_passport_no'  => 'nullable|string|max:50',
            'dob'              => 'nullable|date',
            'gender'           => 'nullable|string|max:50',
            'blood_group'      => 'nullable|string|max:10',
            'present_address'  => 'nullable|string',
            'permanent_address'=> 'nullable|string',
            'profile_picture'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_name'      => 'nullable|string|max:255',
            'intake_no'        => 'nullable|string|max:100',
            'passing_year'     => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'mobile'           => 'required|string|max:50',
            'email'            => 'required|email|max:255|unique:memberships,email',
            'password'         => 'required|string|min:8|confirmed',
            'occupation'       => 'nullable|string|max:255',
            'organization'     => 'nullable|string|max:255',
            'office_address'   => 'nullable|string',
            'membership_type'  => 'required|string|in:General,Life,Associate,Founder',
            'payment_type'     => 'required|string|in:membership_fee,monthly_gm,monthly_ec,lifetime,event_fee,donation',
            'amount'           => 'required|integer|min:1',
            'payment_method'   => 'required|string',
            'status'           => 'required|string|in:active,inactive',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file     = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        $membership = Membership::create([
            ...$data,
            'activated_at' => $data['status'] === 'active' ? now() : null,
            'password' => Hash::make($data['password']),
        ]);

        $this->syncMonthlyPayments($membership);

        return redirect()->route('Admin.membership.index')->with('success', 'Member added successfully!');
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
     * Show the password change form for the specified member.
     */
    public function editPassword(string $id)
    {
        $membership = Membership::findOrFail($id);

        return view('backend.membership.change-password', compact('membership'));
    }

    /**
     * Update the password for the specified member.
     */
    public function updatePassword(Request $request, string $id)
    {
        $membership = Membership::findOrFail($id);

        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $membership->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('Admin.membership.index')
            ->with('success', 'Member password changed successfully!');
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
            'email' => ['required', 'email', 'max:255', Rule::unique('memberships', 'email')->ignore($membership->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'occupation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'office_address' => 'nullable|string',

            'membership_type' => 'required|string|in:General,Life,Associate,Founder',
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

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (($data['status'] ?? $membership->status) === 'active' && !$membership->activated_at) {
            $data['activated_at'] = now();
        }

        $membership->update($data);
        $this->syncMonthlyPayments($membership->refresh());

        return redirect()->route('Admin.membership.index')->with('success', 'Membership updated successfully!');
    }

    /**
     * Approve a membership (set status to active).
     */
    public function approve(string $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->update([
            'status' => 'active',
            'activated_at' => $membership->activated_at ?? now(),
        ]);

        if (!$membership->password && $membership->mobile) {
            $membership->update([
                'password' => Hash::make($membership->mobile),
            ]);
        }

        $this->syncMonthlyPayments($membership->refresh());

        return redirect()->route('Admin.membership.index')->with('success', 'Member approved successfully!');
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(string $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->status = $membership->status === 'active' ? 'inactive' : 'active';
        if ($membership->status === 'active' && !$membership->activated_at) {
            $membership->activated_at = now();
        }
        $membership->save();

        $this->syncMonthlyPayments($membership->refresh());

        return redirect()->route('Admin.membership.index')->with('success', 'Member status updated successfully!');
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

    protected function syncMonthlyPayments(Membership $membership): void
    {
        if ($membership->status !== 'active' || !$membership->requiresMonthlyPayments()) {
            return;
        }

        $this->paymentService->generateMissingPayments($membership);
        $this->paymentService->generateSingleMonth($membership, now()->month, now()->year);
    }
}
