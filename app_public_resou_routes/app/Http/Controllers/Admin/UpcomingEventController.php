<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;

class UpcomingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = UpcomingEvent::orderBy('date', 'asc')->get();
        return view('backend.upcoming_events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.upcoming_events.create');
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
            'date' => 'required|date',
        ]);

        UpcomingEvent::create($request->all());

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = UpcomingEvent::findOrFail($id);
        return view('backend.upcoming_events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = UpcomingEvent::findOrFail($id);
        return view('backend.upcoming_events.edit', compact('event'));
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
            'date' => 'required|date',
        ]);

        $event = UpcomingEvent::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = UpcomingEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event deleted successfully!');
    }
}
