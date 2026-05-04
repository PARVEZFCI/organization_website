<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;

class EventRegistrationController extends Controller
{
    public function index(UpcomingEvent $event)
    {
        $registrations = $event->registrations()
            ->latest()
            ->get();

        return view('backend.upcoming_events.registrations', compact('event', 'registrations'));
    }
}
