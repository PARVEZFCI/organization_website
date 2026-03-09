<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advisors = Advisor::orderBy('order', 'asc')->latest()->get();
        return view('backend.advisors.index', compact('advisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.advisors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'designation', 'description', 'order', 'status']);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/advisors'), $imageName);
            $data['photo'] = 'frontend/img/advisors/' . $imageName;
        }

        Advisor::create($data);

        return redirect()->route('Admin.advisors.index')->with('success', 'Advisor created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advisor = Advisor::findOrFail($id);
        return view('backend.advisors.show', compact('advisor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $advisor = Advisor::findOrFail($id);
        return view('backend.advisors.edit', compact('advisor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $advisor = Advisor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->only(['name', 'designation', 'description', 'order', 'status']);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($advisor->photo && file_exists(public_path($advisor->photo))) {
                unlink(public_path($advisor->photo));
            }

            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/advisors'), $imageName);
            $data['photo'] = 'frontend/img/advisors/' . $imageName;
        }

        $advisor->update($data);

        return redirect()->route('Admin.advisors.index')->with('success', 'Advisor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advisor = Advisor::findOrFail($id);

        // Delete photo
        if ($advisor->photo && file_exists(public_path($advisor->photo))) {
            unlink(public_path($advisor->photo));
        }

        $advisor->delete();

        return redirect()->route('Admin.advisors.index')->with('success', 'Advisor deleted successfully!');
    }
}
