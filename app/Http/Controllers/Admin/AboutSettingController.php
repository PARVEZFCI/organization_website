<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\Request;

class AboutSettingController extends Controller
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
        $setting = AboutSetting::first();
        if (!$setting) {
            $setting = new AboutSetting();
        }
        return view('backend.about_settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->only(['who_we_are', 'mission_vission', 'campus_title', 'campus_description']);
        
        // Handle campus image upload
        if ($request->hasFile('campus_image')) {
            $image = $request->file('campus_image');
            $imageName = 'campus_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/campus'), $imageName);
            $data['campus_image'] = 'frontend/img/campus/' . $imageName;
        }
        
        $setting = AboutSetting::first();
        if ($setting) {
            $setting->update($data);
        } else {
            AboutSetting::create($data);
        }
        return redirect()->back()->with('success', 'About page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
