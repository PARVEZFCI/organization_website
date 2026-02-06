@extends('frontend.layouts.app')

@section('title', 'Executive Committee - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Executive Committee</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Meet our leadership team</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Executive Committee Content -->
    <section class="container my-5">
        <div class="row g-4">
            <!-- President -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="President" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Name Here</h5>
                    <p class="text-primary mb-2"><strong>President</strong></p>
                    <p class="small text-muted mb-0">Leading BESWA with vision and dedication</p>
                </div>
            </div>

            <!-- General Secretary -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Secretary" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Name Here</h5>
                    <p class="text-primary mb-2"><strong>General Secretary</strong></p>
                    <p class="small text-muted mb-0">Coordinating all organizational activities</p>
                </div>
            </div>

            <!-- Treasurer -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Treasurer" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Name Here</h5>
                    <p class="text-primary mb-2"><strong>Treasurer</strong></p>
                    <p class="small text-muted mb-0">Managing financial matters</p>
                </div>
            </div>

            <!-- Vice President -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-3 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" alt="Vice President" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="mb-1" style="color: #1e40af;">Name Here</h5>
                    <p class="text-primary mb-2"><strong>Vice President</strong></p>
                    <p class="small text-muted mb-0">Supporting leadership initiatives</p>
                </div>
            </div>

            <!-- Add more members as needed -->
        </div>
    </section>
@endsection
