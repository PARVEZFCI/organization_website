@extends('frontend.layouts.app')

@section('title', 'Aims & Objectives - BESWA')

@section('content')
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%);min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Aims & Objectives</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">What We Stand For</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.about-submenu')

    <section class="container my-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <h2 class="mb-4" style="color: #1e40af;">Our Aims and Objectives</h2>
                    <p style="line-height: 1.8; color: #475569; font-size: 1.05rem;">
                        The aim of BESWA is to create a united and responsible alumni platform for BIMT ex-students so they can support one another, stand beside present students, and contribute positively to society.
                    </p>
                    <p class="mb-4" style="line-height: 1.8; color: #475569; font-size: 1.05rem;">
                        Through this shared platform, the association seeks to preserve institutional values, build alumni solidarity, and encourage meaningful service through education, welfare, and community-focused initiatives.
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-users me-2"></i>Alumni Unity</h5>
                                <p class="mb-0" style="color: #64748b;">Strengthen bonds and mutual cooperation among BIMT alumni community.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-graduation-cap me-2"></i>Educational Support</h5>
                                <p class="mb-0" style="color: #64748b;">Provide educational assistance and guidance for BIMT students.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-briefcase me-2"></i>Professional Development</h5>
                                <p class="mb-0" style="color: #64748b;">Offer mentoring and career development opportunities for alumni.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-hands-helping me-2"></i>Social Welfare</h5>
                                <p class="mb-0" style="color: #64748b;">Participate in humanitarian activities and community development programs.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-tools me-2"></i>Skill Enhancement</h5>
                                <p class="mb-0" style="color: #64748b;">Conduct training programs and capacity-building initiatives.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border-start border-primary border-4">
                                <h5 class="text-primary mb-2"><i class="fas fa-building me-2"></i>Institutional Heritage</h5>
                                <p class="mb-0" style="color: #64748b;">Preserve the reputation and values of BIMT.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
