<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $setting = HomeSetting::first();
        return view('backend.home_settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $setting = HomeSetting::first();
        $data = $request->only(['title', 'details']);
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/slider'), $imageName);
            $data['banner_image'] = 'frontend/img/slider/' . $imageName;
        }
        if ($setting) {
            $setting->update($data);
        } else {
            HomeSetting::create($data);
        }
        return redirect()->back()->with('success', 'Home settings updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
