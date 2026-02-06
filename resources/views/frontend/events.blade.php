@extends('frontend.layouts.app')

@section('title', 'Events - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Upcoming Events</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Join us in our programs and activities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Content -->
    <section class="container my-5">
        <div class="row g-4">
            @forelse($upcomingEvents ?? [] as $event)
            <div class="col-lg-4 col-md-6">
                <div class="event-card">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400" alt="{{ $event->title ?? 'Event' }}">
                    <div class="p-4">
                        @if($event->date ?? false)
                        <p class="event-date"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                        @endif
                        <h5>{{ $event->title ?? 'Event Title' }}</h5>
                        @if($event->sub_title ?? false)
                        <p>{{ $event->sub_title }}</p>
                        @endif
                        <button class="btn btn-primary-custom btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No upcoming events at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>
@endsection
