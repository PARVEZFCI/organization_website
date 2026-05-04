<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\MembershipFeeSetting;
use Illuminate\Support\Facades\Hash;

class MembershipController extends Controller
{
    protected function allowedMembershipTypes(): array
    {
        return ['General', 'Life', 'Associate', 'Founder'];
    }

    protected function ensureDefaultFeeSettings(): void
    {
        foreach ($this->allowedMembershipTypes() as $type) {
            MembershipFeeSetting::firstOrCreate(
                ['name' => $type],
                ['fee' => 0]
            );
        }
    }

    protected function renderMembershipList(string $type = '') 
    {
        $query = Membership::where('status', 'active');

        if ($type !== '') {
            $query->where('membership_type', $type);
        }

        $memberships = $query->latest()->paginate(12);
        $selectedType = $type;

        return view('frontend.memberships-list', compact('memberships', 'selectedType'));
    }

    public function index(Request $request)
    {
        $type = $request->get('type', '');
        if ($type !== '' && !in_array($type, $this->allowedMembershipTypes(), true)) {
            $type = '';
        }

        return $this->renderMembershipList($type);
    }

    public function create()
    {
        $this->ensureDefaultFeeSettings();
        $feeSettings = MembershipFeeSetting::all()->keyBy('name');
        $fees = $feeSettings->mapWithKeys(function ($setting, $name) {
            return [$name => [
                'fee' => $setting->fee,
                'monthly_fee' => $setting->monthly_fee,
            ]];
        });

        return view('frontend.membership', compact('fees'));
    }

    public function general()
    {
        return $this->renderMembershipList('General');
    }

    public function life()
    {
        return $this->renderMembershipList('Life');
    }

    public function associate()
    {
        return $this->renderMembershipList('Associate');
    }

    public function founder()
    {
        return $this->renderMembershipList('Founder');
    }

    public function store(Request $request)
    {
        $this->ensureDefaultFeeSettings();

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
            'email' => 'required|email|max:255|unique:memberships,email',
            'password' => 'required|string|min:8|confirmed',
            'occupation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'office_address' => 'nullable|string',

            'membership_type' => 'required|string|in:General,Life,Associate,Founder',
            'payment_type' => 'required|string|in:membership_fee',
            'payment_method' => 'required|string',
        ]);

        // Always set status to inactive — admin must approve
        $data['status'] = 'inactive';
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('members'), $filename);
            $data['profile_picture'] = 'members/' . $filename;
        }

        // Get membership fee from settings based on selected membership type
        $fees = MembershipFeeSetting::all()->pluck('fee', 'name');
        $data['amount'] = $fees[$request->membership_type] ?? 0;

        $membership = \App\Models\Membership::create($data);

        // Note: Monthly payments for General Members will be auto-generated
        // when admin approves the membership in the backend

        return redirect()->route('membership.form')->with('success', 'Your membership application has been submitted successfully. We will review and contact you soon.');
    }
}
