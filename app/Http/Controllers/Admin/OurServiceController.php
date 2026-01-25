<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = OurService::latest()->get();
        return view('backend.our_services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.our_services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'sub_title', 'icon']);

        OurService::create($data);

        return redirect()->route('Admin.our_services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = OurService::findOrFail($id);
        return view('backend.our_services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = OurService::findOrFail($id);
        return view('backend.our_services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $service = OurService::findOrFail($id);
        $data = $request->only(['title', 'sub_title', 'icon']);

        $service->update($data);

        return redirect()->route('Admin.our_services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = OurService::findOrFail($id);
        $service->delete();

        return redirect()->route('Admin.our_services.index')->with('success', 'Service deleted successfully!');
    }
}
