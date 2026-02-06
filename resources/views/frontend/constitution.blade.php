@extends('frontend.layouts.app')

@section('title', 'Constitution - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center"style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">BESWA Constitution</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Governing Rules and Regulations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Constitution Content -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white p-5 rounded-3 shadow-sm text-center">
                    <i class="fas fa-file-pdf text-primary mb-4" style="font-size: 5rem;"></i>
                    <h2 class="mb-4" style="color: #1e40af;">Download BESWA Constitution</h2>
                    <p class="mb-4" style="color: #64748b; line-height: 1.8;">
                        Read the official constitution of BIMT Ex-Students Welfare Association (BESWA). 
                        This document outlines our governing principles, membership rules, organizational structure, and operational guidelines.
                    </p>
                    <a href="#" class="btn btn-primary btn-lg">
                        <i class="fas fa-download me-2"></i>Download Constitution (PDF)
                    </a>
                    <p class="mt-3 small text-muted">Registration No. 3162/2017 (Eng.) | Dept. of Social Welfare</p>
                </div>
            </div>
        </div>
    </section>
@endsection
