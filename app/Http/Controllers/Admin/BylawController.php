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
            'title' => 'nullable|string|max:255',
            'file_type' => 'nullable|in:pdf,image',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $bylaw = Bylaw::first();
        if (!$bylaw) {
            $bylaw = new Bylaw();
        }

        $bylaw->content = $request->content;
        $bylaw->title = $request->title;
        $bylaw->file_type = $request->file_type;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($bylaw->file_path && file_exists(public_path($bylaw->file_path))) {
                unlink(public_path($bylaw->file_path));
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = 'constitution_' . time() . '.' . $extension;
            $path = 'frontend/documents/';
            $file->move(public_path($path), $filename);
            $bylaw->file_path = $path . $filename;
        }

        $bylaw->save();

        return redirect()->back()->with('success', 'Constitution updated successfully!');
    }
}
