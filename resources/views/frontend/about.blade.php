@extends('frontend.layouts.app')

@section('title', 'About Us - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">About BESWA</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">BIMT Ex-Students Welfare Association</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: About Us -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <h2 class="mb-4" style="color: #1e40af; border-bottom: 3px solid #3b82f6; display: inline-block; padding-bottom: 8px;">Who We Are</h2>
                    <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        BIMT Ex-Students Welfare Association (BESWA) is a <strong>non-profit, non-political and voluntary social welfare organization</strong> formed by the former students of Bangladesh Institute of Marine Technology (BIMT), Narayanganj. The Association was founded on <strong>07 August 2015</strong> in Chattogram city with the vision of building a united, responsible and socially committed alumni community, inspired by the spirit — <strong style="color: #3b82f6;">"We are Proud BIMTian."</strong>
                    </p>
                    <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        BESWA was officially registered in 2017 under the Department of Social Welfare, Government of the People's Republic of Bangladesh <strong>(Registration No. 3162/2017 Eng.)</strong>. BESWA works to strengthen unity and mutual cooperation among BIMT alumni while preserving the heritage, reputation and values of the institution.
                    </p>
                    <p style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        The Association supports the welfare of present and former students through educational assistance, professional development, employment support and skill enhancement initiatives. At the same time, BESWA actively participates in social welfare, humanitarian activities, disaster response and community development programs, often in collaboration with relevant government and non-government organizations.
                    </p>
                    <p class="mb-0" style="line-height: 1.8; color: #334155; font-size: 1.05rem;">
                        Through volunteerism, transparency and collective responsibility, BESWA strives to contribute to social progress and national development while proudly upholding the identity of BIMT alumni — because <strong style="color: #3b82f6;">"We are Proud BIMTian."</strong>
                    </p>
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

    <!-- Section 2: Mission & Vision -->
    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #1e40af; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.2rem);">
                <i class="fas fa-bullseye me-2"></i>Mission & Vision
            </h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                        <h4 class="mb-3" style="color: #1e40af;"><i class="fas fa-bullseye me-2"></i>Our Mission</h4>
                        <p style="line-height: 1.8; color: #475569;">
                            To unite all former students of Bangladesh Institute of Marine Technology under one platform and work collectively for the welfare of present and former students through educational assistance, professional development, and skill enhancement initiatives.
                        </p>
                        <p class="mb-0" style="line-height: 1.8; color: #475569;">
                            We are committed to preserving BIMT's heritage, supporting alumni networks, and contributing to social welfare and national development through volunteerism, transparency, and responsible action.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                        <h4 class="mb-3" style="color: #1e40af;"><i class="fas fa-eye me-2"></i>Our Vision</h4>
                        <p style="line-height: 1.8; color: #475569;">
                            To be a model alumni association that empowers BIMT graduates to achieve excellence in their professional and personal lives while making meaningful contributions to society.
                        </p>
                        <p class="mb-0" style="line-height: 1.8; color: #475569;">
                            We envision a strong, united community of proud BIMTians who uphold the values of their institution, support each other's growth, and work together for the betterment of humanity.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Aims and Objectives -->
    <section class="container my-5">
        <h2 class="text-center mb-5" style="color: #1e40af; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.2rem);">
            <i class="fas fa-list-check me-2"></i>Aims and Objectives
        </h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-users-line text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Alumni Unity</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Unite all former students of BIMT and strengthen mutual cooperation among them.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-graduation-cap text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Educational Support</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Provide guidance, financial assistance, and educational support to current and former students.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-briefcase text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Professional Development</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Support career growth through employment assistance, networking, and professional training.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-hands-helping text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Social Welfare</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Engage in humanitarian activities, disaster response, and community development programs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-laptop-code text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Skill Enhancement</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Organize training, workshops, and seminars for skill development and capacity building.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100" style="border-left: 4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-landmark text-primary me-3 mt-1" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 style="color: #1e40af;">Institutional Heritage</h5>
                            <p class="mb-0" style="color: #64748b; line-height: 1.6;">Preserve and promote the reputation, values, and heritage of BIMT.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Download Constitution -->
    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white p-5 rounded-3 shadow-sm text-center">
                        <i class="fas fa-file-pdf" style="font-size: 4rem; color: #dc2626; margin-bottom: 1.5rem;"></i>
                        <h3 class="mb-3" style="color: #1e40af; font-weight: 600;">BESWA Constitution</h3>
                        <p class="mb-4" style="color: #64748b; line-height: 1.8;">
                            Read our official constitution document to learn more about BESWA's structure, rules, regulations, and governance framework.
                        </p>
                        <a href="{{ asset('backend/documents/constitution.pdf') }}" download class="btn btn-primary btn-lg" style="background: #3b82f6; border: none; padding: 12px 40px; border-radius: 8px;">
                            <i class="fas fa-download me-2"></i>Download Constitution (PDF)
                        </a>
                        <p class="mt-3 mb-0 small text-muted">
                            <i class="fas fa-info-circle me-1"></i>Last Updated: January 2024 | Size: 2.5 MB
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Message from President & Secretary -->
    <section class="container my-5">
        <h2 class="text-center mb-5" style="color: #1e40af; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.2rem);">
            <i class="fas fa-message me-2"></i>Message from Leadership
        </h2>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('backend/img/president.jpg') }}" alt="President" class="rounded-circle me-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #3b82f6;">
                        <div>
                            <h5 class="mb-1" style="color: #1e40af;">President's Message</h5>
                            <p class="mb-0 text-muted small">President, BESWA</p>
                        </div>
                    </div>
                    <p style="line-height: 1.8; color: #475569; font-style: italic;">
                        "Dear fellow BIMTians, it is my honor to serve as the President of BESWA. Together, we are building a strong community that supports each other and contributes to society. Let us continue to uphold the values of our beloved institution and work towards a brighter future for all."
                    </p>
                    <div class="mt-3 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <p class="mb-0 fw-bold" style="color: #1e40af;">- Name Here</p>
                        <p class="mb-0 small text-muted">President, BESWA</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('backend/img/secretary.jpg') }}" alt="Secretary" class="rounded-circle me-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #3b82f6;">
                        <div>
                            <h5 class="mb-1" style="color: #1e40af;">Secretary's Message</h5>
                            <p class="mb-0 text-muted small">General Secretary, BESWA</p>
                        </div>
                    </div>
                    <p style="line-height: 1.8; color: #475569; font-style: italic;">
                        "As the General Secretary, I am committed to ensuring transparency, accountability, and active participation in all our activities. BESWA is not just an association—it's a family. Let us work together with dedication and pride as we serve our community."
                    </p>
                    <div class="mt-3 pt-3" style="border-top: 1px solid #e2e8f0;">
                        <p class="mb-0 fw-bold" style="color: #1e40af;">- Name Here</p>
                        <p class="mb-0 small text-muted">General Secretary, BESWA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
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