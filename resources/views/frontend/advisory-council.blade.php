@extends('frontend.layouts.app')

@section('title', 'Advisory Council - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Advisory Council</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Our esteemed advisors</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Advisory Council Content -->
    <section class="container my-5">
        <div class="row g-4">
            @forelse($advisors as $advisor)
            <!-- Advisor {{ $loop->iteration }} -->
            <div class="col-lg-4 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="{{ asset($advisor->photo ?? 'https://via.placeholder.com/150') }}" 
                             alt="{{ $advisor->name }}" 
                             class="rounded-circle" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">{{ $advisor->name }}</h5>
                    <p class="text-primary mb-2"><strong>{{ $advisor->designation }}</strong></p>
                    @if($advisor->description)
                    <p class="small text-muted mb-0">{{ $advisor->description }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No advisors available at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>
@endsection
