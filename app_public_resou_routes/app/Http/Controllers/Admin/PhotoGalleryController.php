<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = PhotoGallery::latest()->get();
        return view('backend.photo_gallery.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.photo_gallery.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/gallery'), $imageName);

            PhotoGallery::create([
                'image' => 'frontend/img/gallery/' . $imageName
            ]);
        }

        return redirect()->route('Admin.photo_gallery.index')->with('success', 'Photo uploaded successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = PhotoGallery::findOrFail($id);

        // Delete image file if exists
        if ($photo->image && file_exists(public_path($photo->image))) {
            unlink(public_path($photo->image));
        }

        $photo->delete();

        return redirect()->route('Admin.photo_gallery.index')->with('success', 'Photo deleted successfully!');
    }
}
