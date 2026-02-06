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
            <!-- Advisor 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Advisor" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Advisor Name</h5>
                    <p class="text-primary mb-2"><strong>Chief Advisor</strong></p>
                    <p class="small text-muted mb-0">Providing strategic guidance and wisdom</p>
                </div>
            </div>

            <!-- Advisor 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Advisor" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Advisor Name</h5>
                    <p class="text-primary mb-2"><strong>Senior Advisor</strong></p>
                    <p class="small text-muted mb-0">Supporting organizational development</p>
                </div>
            </div>

            <!-- Advisor 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Advisor" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Advisor Name</h5>
                    <p class="text-primary mb-2"><strong>Advisor</strong></p>
                    <p class="small text-muted mb-0">Contributing expertise and experience</p>
                </div>
            </div>

            <!-- Add more advisors as needed -->
        </div>
    </section>
@endsection
