<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipFeeSetting;

class AdminMembershipFeeController extends Controller
{
    public function index()
    {
        $fees = MembershipFeeSetting::all();
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
        ]);
        $fee->update($data);
        return redirect()->route('Admin.membership_fees.index')->with('success', 'Fee updated successfully!');
    }
}
