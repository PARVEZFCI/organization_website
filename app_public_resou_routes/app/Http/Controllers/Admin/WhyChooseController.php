<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChoose;
use Illuminate\Http\Request;

class WhyChooseController extends Controller
{
    public function index()
    {
        $whyChooses = WhyChoose::all();
        return view('backend.why_chooses.index', compact('whyChooses'));
    }

    public function create()
    {
        return view('backend.why_chooses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = ['name' => $validated['name']];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/WhyUs'), $imageName);
            $data['image'] = 'frontend/img/WhyUs/' . $imageName;
        }
        WhyChoose::create($data);
        return redirect()->route('Admin.why_chooses.index')->with('success', 'Why Choose item added successfully!');
    }

    public function edit($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        return view('backend.why_chooses.edit', compact('whyChoose'));
    }

    public function update(Request $request, $id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = ['name' => $validated['name']];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/WhyUs'), $imageName);
            $data['image'] = 'frontend/img/WhyUs/' . $imageName;
        }
        $whyChoose->update($data);
        return redirect()->route('Admin.why_chooses.index')->with('success', 'Why Choose item updated successfully!');
    }

    public function destroy($id)
    {
        $whyChoose = WhyChoose::findOrFail($id);
        $whyChoose->delete();
        return redirect()->route('Admin.why_chooses.index')->with('success', 'Why Choose item deleted successfully!');
    }
}
