<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bylaw;
use Illuminate\Http\Request;

class BylawController extends Controller
{
    public function edit()
    {
        $bylaw = Bylaw::first();
        return view('backend.bylaws.edit', compact('bylaw'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
        ]);

        $bylaw = Bylaw::first();
        if ($bylaw) {
            $bylaw->update(['content' => $request->content]);
        } else {
            Bylaw::create(['content' => $request->content]);
        }

        return redirect()->back()->with('success', 'Bylaws updated successfully!');
    }
}
