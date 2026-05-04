@extends('frontend.layouts.app')

@section('title', 'Events - BESWA')

@section('content')
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.8rem); font-weight: 700;">Upcoming Events</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.92); font-size: clamp(1rem, 3vw, 1.15rem);">Explore upcoming programs, view details, and register with a smoother member-first experience.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row g-4">
            @forelse($upcomingEvents as $event)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 18px;">
                        <div style="height: 220px; background: #e2e8f0;">
                            @if($event->banner_path)
                                <img src="{{ asset($event->banner_path) }}" alt="{{ $event->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-white" style="background: linear-gradient(135deg, #1d4ed8, #0f172a);">
                                    <div class="text-center px-4">
                                        <div class="small text-uppercase mb-2" style="letter-spacing: .2em;">Event</div>
                                        <h4 class="mb-0">{{ $event->title }}</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <div class="small text-primary fw-bold mb-2">{{ $event->date->format('F d, Y') }}</div>
                            <h4 class="mb-2">{{ $event->title }}</h4>
                            @if($event->sub_title)
                                <p class="text-muted mb-2">{{ $event->sub_title }}</p>
                            @endif
                            @if($event->venue)
                                <p class="small text-muted mb-2"><i class="fas fa-map-marker-alt me-2"></i>{{ $event->venue }}</p>
                            @endif
                            <p class="text-muted flex-grow-1">{!! \Illuminate\Support\Str::limit(strip_tags($event->details), 140) !!}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge {{ $event->is_registration_enabled ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $event->is_registration_enabled ? 'Registration Available' : 'Registration Closed' }}
                                </span>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h3 class="mb-3">No upcoming events yet</h3>
                        <p class="text-muted mb-0">New programs will appear here once they are published from the admin panel.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $upcomingEvents->links() }}
        </div>
    </section>
@endsection
