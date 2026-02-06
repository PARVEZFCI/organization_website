@extends('frontend.layouts.app')

@section('title', 'News - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Latest News</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Stay updated with BESWA activities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="activity-card">
                    <img src="https://via.placeholder.com/400x300" alt="News">
                    <div class="activity-card-body">
                        <span class="badge bg-primary mb-2">Latest</span>
                        <h5>News Title Here</h5>
                        <p class="text-muted small mb-2"><i class="far fa-calendar-alt me-2"></i>January 27, 2026</p>
                        <p>Brief description of the news article goes here...</p>
                        <button class="btn btn-primary-custom btn-sm">Read More</button>
                    </div>
                </div>
            </div>
            <!-- More news items will be added dynamically -->
        </div>
    </section>
@endsection
