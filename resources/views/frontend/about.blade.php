@extends('frontend.layouts.app')

@section('title', 'About Us - BESWA')

@section('content')
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%);min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">About BESWA</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">BIMT Ex-Students Welfare Association</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.about-submenu')

    <section class="container my-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <h2 class="mb-4" style="color: #1e40af; border-bottom: 3px solid #3b82f6; display: inline-block; padding-bottom: 8px;">Who We Are</h2>
                    @if(!empty($aboutSetting?->who_we_are))
                        <div style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                            {!! $aboutSetting->who_we_are !!}
                        </div>
                    @else
                        <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                            BIMT Ex-Students Welfare Association (BESWA) is a <strong>non-profit, non-political and voluntary social welfare organization</strong> formed by the former students of Bangladesh Institute of Marine Technology (BIMT), Narayanganj.
                        </p>
                        <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                            The association was founded on <strong>07 August 2015</strong> in Chattogram and officially registered in 2017 under the Department of Social Welfare, Government of the People's Republic of Bangladesh <strong>(Registration No. 3162/2017 Eng.)</strong>.
                        </p>
                        <p class="mb-0" style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                            BESWA works to strengthen alumni unity, support present and former students, preserve BIMT's heritage, and contribute to social welfare and national development.
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-top: 4px solid #3b82f6;">
                    <h5 class="mb-4" style="color: #1e40af;"><i class="fas fa-info-circle me-2"></i>BESWA at a Glance</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <i class="fas fa-building text-primary me-2"></i>
                            <strong style="color: #1e293b;">Nature:</strong><br>
                            <span style="color: #64748b;">Non-profit, non-political, voluntary</span>
                        </li>
                        <li class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            <strong style="color: #1e293b;">Founded:</strong><br>
                            <span style="color: #64748b;">07 August 2015</span>
                        </li>
                        <li class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <strong style="color: #1e293b;">Location:</strong><br>
                            <span style="color: #64748b;">Chattogram, Bangladesh</span>
                        </li>
                        <li class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <i class="fas fa-stamp text-primary me-2"></i>
                            <strong style="color: #1e293b;">Registration:</strong><br>
                            <span style="color: #64748b;">Dept. of Social Welfare</span>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-certificate text-primary me-2"></i>
                            <strong style="color: #1e293b;">Reg. No.:</strong><br>
                            <span style="color: #64748b;">3162/2017 (Eng.)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #1e40af; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.2rem);">
                Our Core Values
            </h2>
            <div class="row g-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm text-center h-100">
                        <i class="fas fa-heart text-primary mb-3" style="font-size: 2.5rem;"></i>
                        <h5 class="fw-bold mb-2" style="color: #1e40af;">Volunteerism</h5>
                        <p class="mb-0 text-muted small">Serving with dedication and passion</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm text-center h-100">
                        <i class="fas fa-eye text-primary mb-3" style="font-size: 2.5rem;"></i>
                        <h5 class="fw-bold mb-2" style="color: #1e40af;">Transparency</h5>
                        <p class="mb-0 text-muted small">Accountable and open in all actions</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm text-center h-100">
                        <i class="fas fa-users text-primary mb-3" style="font-size: 2.5rem;"></i>
                        <h5 class="fw-bold mb-2" style="color: #1e40af;">Responsibility</h5>
                        <p class="mb-0 text-muted small">Collective action for common good</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm text-center h-100">
                        <i class="fas fa-trophy text-primary mb-3" style="font-size: 2.5rem;"></i>
                        <h5 class="fw-bold mb-2" style="color: #1e40af;">Pride</h5>
                        <p class="mb-0 text-muted small">We are Proud BIMTian</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
