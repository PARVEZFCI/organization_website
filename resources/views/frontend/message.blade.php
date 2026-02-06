@extends('frontend.layouts.app')

@section('title', 'Message from Leadership - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); min-height: 30vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Message from Leadership</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Words from the President & Secretary</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Messages Content -->
    <section class="container my-5">
        <div class="row g-4">
            <!-- President's Message -->
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/150" alt="President" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4 class="mb-1" style="color: #1e40af;">President's Name</h4>
                        <p class="text-muted mb-0">President, BESWA</p>
                    </div>
                    <p style="line-height: 1.8; color: #334155;">
                        Dear BIMT Alumni,<br><br>
                        It is my honor to serve as President of BESWA. Our association stands as a testament to the enduring spirit of unity and cooperation among BIMT graduates. Together, we continue to uphold the values that made us proud BIMTians.
                        <br><br>
                        Let us work hand in hand to strengthen our community and contribute meaningfully to society.
                    </p>
                    <p class="mb-0 text-end"><strong>- President</strong></p>
                </div>
            </div>

            <!-- Secretary's Message -->
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/150" alt="Secretary" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4 class="mb-1" style="color: #1e40af;">Secretary's Name</h4>
                        <p class="text-muted mb-0">General Secretary, BESWA</p>
                    </div>
                    <p style="line-height: 1.8; color: #334155;">
                        Greetings to all BESWA members,<br><br>
                        As Secretary, I am committed to fostering transparency and efficiency in all our operations. Through collective responsibility and dedication, we can achieve our mission of supporting BIMT students and alumni while contributing to national development.
                        <br><br>
                        Together, we are proud BIMTians.
                    </p>
                    <p class="mb-0 text-end"><strong>- General Secretary</strong></p>
                </div>
            </div>
        </div>
    </section>
@endsection
