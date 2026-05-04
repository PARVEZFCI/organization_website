<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipFeeSetting;

class AdminMembershipFeeController extends Controller
{
    protected function ensureDefaultFeeSettings(): void
    {
        foreach (['General', 'Life', 'Associate', 'Founder'] as $type) {
            MembershipFeeSetting::firstOrCreate(
                ['name' => $type],
                ['fee' => 0]
            );
        }
    }

    public function index()
    {
        $this->ensureDefaultFeeSettings();
        $order = ['General', 'Life', 'Associate', 'Founder'];
        $fees = MembershipFeeSetting::all()->sortBy(function ($fee) use ($order) {
            $position = array_search($fee->name, $order, true);
            return $position === false ? 999 : $position;
        });
        return view('backend.membership_fee_settings.index', compact('fees'));
    }

    public function edit($id)
    {
        $fee = MembershipFeeSetting::findOrFail($id);
        return view('backend.membership_fee_settings.edit', compact('fee'));
    }

    public function update(Request $request, $id)
    {
        $fee = MembershipFeeSetting::findOrFail($id);
        $data = $request->validate([
            'fee' => 'required|numeric|min:0',
            'monthly_fee' => 'required|numeric|min:0',
        ]);
        $fee->update($data);
        return redirect()->route('Admin.membership_fees.index')->with('success', 'Fee updated successfully!');
    }
}
