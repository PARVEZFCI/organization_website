@extends('frontend.layouts.app')

@section('title', 'Our Activities - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Our Activities</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Discover our programs and initiatives</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Content -->
    <section class="container my-5">
        <div class="row g-4">
            @forelse($ongoingActivities ?? [] as $activity)
            <div class="col-lg-4 col-md-6">
                <div class="activity-card">
                    @if($activity->thumbnail ?? false)
                    <img src="/{{ $activity->thumbnail }}" alt="{{ $activity->title }}">
                    @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image">
                    @endif
                    <div class="activity-card-body">
                        <h5>{{ $activity->title ?? 'Activity Title' }}</h5>
                        @if($activity->sub_title ?? false)
                        <p>{{ $activity->sub_title }}</p>
                        @endif
                        <button class="btn btn-primary-custom btn-sm">Read More</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No activities available at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>
@endsection
