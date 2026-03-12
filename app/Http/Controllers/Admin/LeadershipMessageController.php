<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMessage;
use Illuminate\Http\Request;

class LeadershipMessageController extends Controller
{
    public function index()
    {
        $messages = LeadershipMessage::orderBy('display_order')->get();
        return view('backend.leadership_messages.index', compact('messages'));
    }

    public function create()
    {
        return view('backend.leadership_messages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'message' => 'required|string',
            'display_order' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('leadership'), $filename);
            $data['image'] = 'leadership/' . $filename;
        }

        LeadershipMessage::create($data);

        return redirect()->route('Admin.leadership_messages.index')->with('success', 'Leadership message created successfully!');
    }

    public function edit(string $id)
    {
        $message = LeadershipMessage::findOrFail($id);
        return view('backend.leadership_messages.edit', compact('message'));
    }

    public function update(Request $request, string $id)
    {
        $message = LeadershipMessage::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'message' => 'required|string',
            'display_order' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($message->image && file_exists(public_path($message->image))) {
                unlink(public_path($message->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('leadership'), $filename);
            $data['image'] = 'leadership/' . $filename;
        }

        $message->update($data);

        return redirect()->route('Admin.leadership_messages.index')->with('success', 'Leadership message updated successfully!');
    }

    public function destroy(string $id)
    {
        $message = LeadershipMessage::findOrFail($id);

        // Delete image
        if ($message->image && file_exists(public_path($message->image))) {
            unlink(public_path($message->image));
        }

        $message->delete();

        return redirect()->route('Admin.leadership_messages.index')->with('success', 'Leadership message deleted successfully!');
    }
}
