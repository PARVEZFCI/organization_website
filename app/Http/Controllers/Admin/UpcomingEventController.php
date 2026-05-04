<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UpcomingEventController extends Controller
{
    public function index()
    {
        $events = UpcomingEvent::withCount('registrations')->orderBy('date', 'asc')->get();

        return view('backend.upcoming_events.index', compact('events'));
    }

    public function create()
    {
        return view('backend.upcoming_events.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['fee_config'] = $this->normalizeFeeConfig($request->input('fees', []));
        $data['banner_path'] = $this->storeBanner($request);

        UpcomingEvent::create($data);

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event created successfully.');
    }

    public function show(string $id)
    {
        return redirect()->route('Admin.upcoming_events.edit', $id);
    }

    public function edit(string $id)
    {
        $event = UpcomingEvent::findOrFail($id);

        return view('backend.upcoming_events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        $event = UpcomingEvent::findOrFail($id);
        $data = $this->validatedData($request);
        $data['fee_config'] = $this->normalizeFeeConfig($request->input('fees', []));
        $data['banner_path'] = $this->storeBanner($request, $event->banner_path);

        $event->update($data);

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(string $id)
    {
        $event = UpcomingEvent::findOrFail($id);

        if ($event->banner_path && file_exists(public_path($event->banner_path))) {
            unlink(public_path($event->banner_path));
        }

        $event->delete();

        return redirect()->route('Admin.upcoming_events.index')->with('success', 'Event deleted successfully.');
    }

    public function togglePin($id)
    {
        $event = UpcomingEvent::findOrFail($id);
        $event->is_pinned = !$event->is_pinned;
        $event->save();

        $message = $event->is_pinned ? 'Event pinned to marquee.' : 'Event unpinned from marquee.';

        return redirect()->back()->with('success', $message);
    }

    protected function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'date' => 'required|date',
            'venue' => 'nullable|string|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'registration_deadline' => 'nullable|date',
            'registration_notes' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'max_registrations' => 'nullable|integer|min:1',
            'is_registration_enabled' => 'nullable|boolean',
            'requires_payment' => 'nullable|boolean',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]) + [
            'is_registration_enabled' => $request->boolean('is_registration_enabled'),
            'requires_payment' => $request->boolean('requires_payment'),
        ];
    }

    protected function normalizeFeeConfig(array $fees): array
    {
        $normalized = [];

        foreach (array_merge(['default'], UpcomingEvent::MEMBER_TYPES) as $group) {
            $normalized[$group] = [];

            foreach (UpcomingEvent::PARTICIPANT_TYPES as $participantType) {
                $normalized[$group][$participantType] = (float) Arr::get($fees, "{$group}.{$participantType}", 0);
            }
        }

        return $normalized;
    }

    protected function storeBanner(Request $request, ?string $existingPath = null): ?string
    {
        if (!$request->hasFile('banner')) {
            return $existingPath;
        }

        if ($existingPath && file_exists(public_path($existingPath))) {
            unlink(public_path($existingPath));
        }

        $file = $request->file('banner');
        $directory = public_path('events/banners');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'events/banners/' . $filename;
    }
}
