<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OngoingActivity;
use Illuminate\Http\Request;

class OngoingActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = OngoingActivity::latest()->get();
        return view('backend.ongoing_activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ongoing_activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'sub_title', 'details']);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/activities'), $imageName);
            $data['thumbnail'] = 'frontend/img/activities/' . $imageName;
        }

        OngoingActivity::create($data);

        return redirect()->route('Admin.ongoing_activities.index')->with('success', 'Activity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = OngoingActivity::findOrFail($id);
        return view('backend.ongoing_activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = OngoingActivity::findOrFail($id);
        return view('backend.ongoing_activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $activity = OngoingActivity::findOrFail($id);
        $data = $request->only(['title', 'sub_title', 'details']);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($activity->thumbnail && file_exists(public_path($activity->thumbnail))) {
                unlink(public_path($activity->thumbnail));
            }

            $image = $request->file('thumbnail');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/activities'), $imageName);
            $data['thumbnail'] = 'frontend/img/activities/' . $imageName;
        }

        $activity->update($data);

        return redirect()->route('Admin.ongoing_activities.index')->with('success', 'Activity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = OngoingActivity::findOrFail($id);

        // Delete thumbnail file if exists
        if ($activity->thumbnail && file_exists(public_path($activity->thumbnail))) {
            unlink(public_path($activity->thumbnail));
        }

        $activity->delete();

        return redirect()->route('Admin.ongoing_activities.index')->with('success', 'Activity deleted successfully!');
    }
}
