<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::latest()->get();
        return view('backend.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:teams,slug',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'designation', 'details']);

        // Generate slug from name if not provided
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/team'), $imageName);
            $data['image'] = 'frontend/img/team/' . $imageName;
        }

        Team::create($data);

        return redirect()->route('Admin.teams.index')->with('success', 'Team member created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);
        return view('backend.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::findOrFail($id);
        return view('backend.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:teams,slug,' . $id,
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'designation', 'details']);

        // Generate slug from name if not provided
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/team'), $imageName);
            $data['image'] = 'frontend/img/team/' . $imageName;
        }

        $team->update($data);

        return redirect()->route('Admin.teams.index')->with('success', 'Team member updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        // Delete image file if exists
        if ($team->image && file_exists(public_path($team->image))) {
            unlink(public_path($team->image));
        }

        $team->delete();

        return redirect()->route('Admin.teams.index')->with('success', 'Team member deleted successfully!');
    }
}
