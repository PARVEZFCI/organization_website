@extends('frontend.layouts.app')

@section('title', 'Home - Training Center')

@section('content')
@php
$homeSettings = \App\Models\HomeSetting::first();
@endphp
  <!-- Hero Section -->
    <section id="home" class="hero-section" style="background: linear-gradient(rgb(178 153 49), rgba(4, 120, 87, 0.85)), url('{{ $homeSettings->banner_image }}') center/cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10">
                    <div class="hero-content">
                        <h1>{{ $homeSettings->title }}</h1>
                        <p>{{ $homeSettings->details }}</p>
                        <button class="btn btn-primary-custom">Join Us Today</button>
                        <a href="{{ route('donation.page') }}" class="btn btn-outline-custom">Donate Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
   <div class="container">
        <div class="search-section">
            <h3 class="search-title text-center mb-4">Make Your Donation</h3>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('bkash.create') }}" method="POST" id="donationForm">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold">Donation Fund <sup style="color: red;">*</sup></label>
                        <select class="form-select" name="donation_fund" required>
                            <option value="">Select</option>
                            <option value="general_fund">General Fund</option>
                            <option value="education_fund">Education Fund</option>
                            <option value="healthcare_fund">Healthcare Fund</option>
                            <option value="orphan_support">Orphan Support</option>
                            <option value="skill_development">Skill Development</option>
                            <option value="emergency_relief">Emergency Relief</option>
                        </select>
                        @error('donation_fund')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold">Phone / Email <sup style="color: red;">*</sup> <i class="fas fa-info-circle" style="font-size: 0.85rem; color: #666;"></i></label>
                        <input type="text" class="form-control" name="phone_email" placeholder="Type mobile/email" required>
                        @error('phone_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold">Donation Amount <sup style="color: red;">*</sup> </label> <small>(Minimum: ৳10)</small>
                        <input type="number" class="form-control" name="amount" placeholder="৳ Write in number" min="10" required>
                        @error('amount')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <button type="submit" class="btn btn-primary-custom w-100" style="padding: 13px 30px;">
                            <i class="fas fa-hand-holding-heart"></i> Donate via bKash
                        </button>
                    </div>
                </div>
            </form>
            <p class="text-center mt-4 mb-0" style="color: #333; font-size: 0.95rem;">
                <i class="fas fa-shield-alt text-success"></i> Secure payment via bKash | You will receive tax relief when you donate to Dream Youth Club.
                <a href="#" style="color: #16a34a; text-decoration: none; font-weight: 600;">Click here to learn more</a>
            </p>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" class="container my-5">
        <h2 class="section-title">Our Services</h2>
        <p class="section-subtitle">Comprehensive agricultural solutions for modern farming</p>
        <div class="row g-4">
            @forelse($ourServices as $service)
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <i class="{{ $service->icon }}"></i>
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->sub_title }}</p>
                    <button class="btn btn-primary-custom btn-sm">Learn More</button>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No services available at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Activities Section -->
    <section id="activities" class="container my-5">
        <h2 class="section-title">Ongoing Activities</h2>
        <p class="section-subtitle">Discover our current programs and initiatives</p>
        <div class="row g-4">
            @forelse($ongoingActivities as $activity)
            <div class="col-lg-4 col-md-6">
                <div class="activity-card">
                    @if($activity->thumbnail)
                    <img src="/{{ $activity->thumbnail }}" alt="{{ $activity->title }}">
                    @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image">
                    @endif
                    <div class="activity-card-body">
                        <h5>{{ $activity->title }}</h5>
                        @if($activity->sub_title)
                        <p>{{ $activity->sub_title }}</p>
                        @endif
                        <button class="btn btn-primary-custom btn-sm">Read More</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No ongoing activities at the moment.</p>
            </div>
            @endforelse
        </div>
        @if($ongoingActivities->count() > 0)
        <div class="text-center mt-5">
            <button class="btn btn-primary-custom">View All Activities</button>
        </div>
        @endif
    </section>

    <!-- Online Office Section -->
    <section class="office-section">
        <div class="container">
            <h2 class="section-title text-white">Connect With Us Online</h2>
            <p class="text-center mb-5">Register now to access all services online easily and conveniently</p>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="office-card">
                        <i class="fas fa-user-plus office-icon"></i>
                        <h5>Registration</h5>
                        <p>Create your account and get started with our services</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="office-card">
                        <i class="fas fa-file-alt office-icon"></i>
                        <h5>Applications</h5>
                        <p>Submit applications online for various programs</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="office-card">
                        <i class="fas fa-headset office-icon"></i>
                        <h5>Support</h5>
                        <p>Get help for any issues or questions you may have</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="office-card">
                        <i class="fas fa-download office-icon"></i>
                        <h5>Downloads</h5>
                        <p>Access and download necessary forms and documents</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="container my-5">
        <h2 class="section-title">Photo Gallery</h2>
        <p class="section-subtitle">Glimpses of our work and activities</p>
        <div class="row g-4">
            @forelse($photoGalleries as $photo)
            <div class="col-lg-4 col-md-6">
                @if($photo->image)
                <img src="/{{ $photo->image }}" alt="Gallery" class="gallery-img">
                @else
                <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image" class="gallery-img">
                @endif
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No photos available in the gallery.</p>
            </div>
            @endforelse
        </div>
        @if($photoGalleries->count() > 0)
        <div class="text-center mt-5">
            <button class="btn btn-primary-custom">View More</button>
        </div>
        @endif
    </section>

    <!-- Events Section -->
    <section id="events" class="container my-5">
        <h2 class="section-title">Upcoming Events</h2>
        <p class="section-subtitle">Join us in our upcoming programs and exhibitions</p>
        <div class="row g-4">
            @forelse($upcomingEvents as $event)
            <div class="col-lg-4 col-md-6">
                <div class="event-card">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400" alt="{{ $event->title }}">
                    <div class="p-4">
                        @if($event->date)
                        <p class="event-date"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                        @endif
                        <h5>{{ $event->title }}</h5>
                        @if($event->sub_title)
                        <p>{{ $event->sub_title }}</p>
                        @endif
                        <button class="btn btn-primary-custom btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No upcoming events at the moment.</p>
            </div>
            @endforelse
        </div>
        @if($upcomingEvents->count() > 0)
        <div class="text-center mt-5">
            <button class="btn btn-primary-custom">View All Events</button>
        </div>
        @endif
    </section>
@endsection
