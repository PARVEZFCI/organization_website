@extends('frontend.layouts.app')

@section('title', 'Mission & Vision - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); min-height: 30vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Mission & Vision</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Our Purpose and Direction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Content -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <h2 class="mb-4" style="color: #1e40af;"><i class="fas fa-bullseye me-2"></i>Our Mission</h2>
                    <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        To strengthen unity and mutual cooperation among BIMT alumni while preserving the heritage, reputation and values of the institution. We support the welfare of present and former students through educational assistance, professional development, employment support and skill enhancement initiatives.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <h2 class="mb-4" style="color: #1e40af;"><i class="fas fa-eye me-2"></i>Our Vision</h2>
                    <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        To build a united, responsible and socially committed alumni community inspired by the spirit <strong style="color: #3b82f6;">"We are Proud BIMTian"</strong>. We envision a society where BIMT alumni contribute meaningfully to social progress and national development through volunteerism, transparency and collective responsibility.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
