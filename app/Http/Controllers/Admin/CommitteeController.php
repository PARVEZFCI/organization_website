<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $committees = Committee::orderBy('position_order')->get();
        return view('backend.committee.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.committee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'position_order' => 'required|integer',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['position_order', 'name', 'position', 'description', 'email', 'phone']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/committee'), $imageName);
            $data['image'] = 'committee/' . $imageName;
        }

        Committee::create($data);

        return redirect()->route('Admin.committee.index')->with('success', 'Committee member created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $committee = Committee::findOrFail($id);
        return view('backend.committee.edit', compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $committee = Committee::findOrFail($id);

        $request->validate([
            'position_order' => 'required|integer',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['position_order', 'name', 'position', 'description', 'email', 'phone']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($committee->image && file_exists(public_path('storage/' . $committee->image))) {
                unlink(public_path('storage/' . $committee->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/committee'), $imageName);
            $data['image'] = 'committee/' . $imageName;
        }

        $committee->update($data);

        return redirect()->route('Admin.committee.index')->with('success', 'Committee member updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $committee = Committee::findOrFail($id);

        // Delete image if exists
        if ($committee->image && file_exists(public_path('storage/' . $committee->image))) {
            unlink(public_path('storage/' . $committee->image));
        }

        $committee->delete();

        return redirect()->route('Admin.committee.index')->with('success', 'Committee member deleted successfully!');
    }
}
