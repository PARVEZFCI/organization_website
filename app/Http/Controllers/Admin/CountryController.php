<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('backend.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('backend.countries.create');
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
            $image->move(public_path('frontend/img/studyIn'), $imageName);
            $data['image'] = 'frontend/img/studyIn/' . $imageName;
        }
        Country::create($data);
        return redirect()->route('Admin.countries.index')->with('success', 'Country added successfully!');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('backend.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = ['name' => $validated['name']];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/studyIn'), $imageName);
            $data['image'] = 'frontend/img/studyIn/' . $imageName;
        }
        $country->update($data);
        return redirect()->route('Admin.countries.index')->with('success', 'Country updated successfully!');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('Admin.countries.index')->with('success', 'Country deleted successfully!');
    }
}
