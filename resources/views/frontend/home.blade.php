@extends('frontend.layouts.app')

@section('title', 'Home - BESWA')

@section('content')
@php
$homeSettings = \App\Models\HomeSetting::first();
@endphp

{{-- ─────────────────────────────── HERO SLIDER ─────────────────────────────── --}}
<section id="home" class="hero-section p-0">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            @if(isset($pinnedPhotos) && $pinnedPhotos->count() > 0)
                @foreach($pinnedPhotos as $index => $photo)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            @else
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @endif
        </div>
        
        <div class="carousel-inner">
            @if(isset($pinnedPhotos) && $pinnedPhotos->count() > 0)
                @foreach($pinnedPhotos as $index => $photo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-slide" style="background-image: url('/{{ $photo->image }}');">
                            <div class="hero-overlay"></div>
                            <div class="container h-100 position-relative" style="z-index: 2;">
                                <div class="row h-100 align-items-center">
                                    <div class="col-lg-8 col-md-10">
                                        <div class="hero-content text-white">
                                            <h1 class="display-4 fw-bold mb-4">{{ $homeSettings->title }}</h1>
                                            <p class="lead mb-4">{{ $homeSettings->details }}</p>
                                            <a href="{{ route('membership.form') }}" class="btn btn-primary-custom me-2">Become a Member</a>
                                            <a href="{{ route('donation.page') }}" class="btn btn-outline-light">Payment Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback if no pinned photos --}}
                <div class="carousel-item active">
                    <div class="hero-slide" style="background: linear-gradient(#fff, rgba(130, 194, 255, 0.85)), url('{{ $homeSettings->banner_image }}');">
                        <div class="hero-overlay"></div>
                        <div class="container h-100 position-relative" style="z-index: 2;">
                            <div class="row h-100 align-items-center">
                                <div class="col-lg-8 col-md-10">
                                    <div class="hero-content">
                                        <h1 class="display-4 fw-bold mb-4">{{ $homeSettings->title }}</h1>
                                        <p class="lead mb-4">{{ $homeSettings->details }}</p>
                                        <a href="{{ route('membership.form') }}" class="btn btn-primary-custom me-2">Become a Member</a>
                                        <a href="{{ route('donation.page') }}" class="btn btn-outline-custom">Payment Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        @if(isset($pinnedPhotos) && $pinnedPhotos->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
</section>

{{-- ─────────────────────────────── WHAT WE DO ─────────────────────────────── --}}
<section id="services" class="container my-5">
    <h2 class="section-title">What We Do</h2>
    <p class="section-subtitle">Key areas where BESWA creates impact</p>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-handshake-angle"></i>
                <h4>Unity & Cooperation</h4>
                <p>Strengthening bonds among alumni and fostering mutual support.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-school"></i>
                <h4>Educational Assistance</h4>
                <p>Scholarships, mentoring, and academic guidance for students.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-briefcase"></i>
                <h4>Employment Support</h4>
                <p>Job placement, career counseling, and industry networking.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-screwdriver-wrench"></i>
                <h4>Skill Enhancement</h4>
                <p>Training programs and workshops for professional growth.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-shield-heart"></i>
                <h4>Humanitarian Aid</h4>
                <p>Disaster response and social welfare initiatives.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-building-columns"></i>
                <h4>Collaboration</h4>
                <p>Working with government and NGOs to scale impact.</p>
            </div>
        </div>
    </div>
</section>

{{-- ─────────────────────────────── MESSAGES ─────────────────────────────── --}}
<section class="py-5" style="background: linear-gradient(135deg, #f8faff 0%, #eef2ff 100%);">
    <div class="container">
        <h2 class="section-title">Leadership Messages</h2>
        <p class="section-subtitle">Inspiring words from our respected leaders</p>
        <div class="row g-4 mt-2">

            {{-- President --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="p-0">
                        @if(isset($president) && $president->image)
                            <img src="/{{ $president->image }}" alt="{{ $president->name }}"
                                 class="w-100" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height:240px; background: linear-gradient(135deg,#667eea,#764ba2);">
                                <i class="fas fa-user-tie fa-4x text-white opacity-75"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width:42px;height:42px;background:linear-gradient(135deg,#667eea,#764ba2);">
                                <i class="fas fa-star text-white" style="font-size:.85rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-700">{{ $president->name ?? 'President' }}</h6>
                                <small class="text-muted">{{ $president->position ?? 'President' }}</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left text-primary opacity-25 fa-2x mb-2"></i>
                        <p class="text-muted mb-0" style="font-size:.93rem;line-height:1.7;">
                            {{ ($president && $president->description) ? Str::limit($president->description, 200) : 'We are committed to the welfare and growth of every BIMT alumnus. Together we shall build a stronger community.' }}
                        </p>
                    </div>
                    <div class="px-4 pb-4">
                        <a href="{{ route('message') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Read Full Message</a>
                    </div>
                </div>
            </div>

            {{-- General Secretary --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="p-0">
                        @if(isset($generalSecretary) && $generalSecretary->image)
                            <img src="/{{ $generalSecretary->image }}" alt="{{ $generalSecretary->name }}"
                                 class="w-100" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height:240px; background: linear-gradient(135deg,#0ea5e9,#0284c7);">
                                <i class="fas fa-user-tie fa-4x text-white opacity-75"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width:42px;height:42px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                                <i class="fas fa-pen-nib text-white" style="font-size:.85rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-700">{{ $generalSecretary->name ?? 'General Secretary' }}</h6>
                                <small class="text-muted">{{ $generalSecretary->position ?? 'General Secretary' }}</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left text-info opacity-25 fa-2x mb-2"></i>
                        <p class="text-muted mb-0" style="font-size:.93rem;line-height:1.7;">
                            {{ ($generalSecretary && $generalSecretary->description) ? Str::limit($generalSecretary->description, 200) : 'Our organization thrives on the dedication of its members. Let us continue to serve one another with sincerity and commitment.' }}
                        </p>
                    </div>
                    <div class="px-4 pb-4">
                        <a href="{{ route('message') }}" class="btn btn-sm btn-outline-info rounded-pill px-3">Read Full Message</a>
                    </div>
                </div>
            </div>

            {{-- Chief Advisor --}}
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div class="p-0">
                        @if(isset($chiefAdvisor) && $chiefAdvisor->image)
                            <img src="/{{ $chiefAdvisor->image }}" alt="{{ $chiefAdvisor->name }}"
                                 class="w-100" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height:240px; background: linear-gradient(135deg,#10b981,#059669);">
                                <i class="fas fa-user-tie fa-4x text-white opacity-75"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width:42px;height:42px;background:linear-gradient(135deg,#10b981,#059669);">
                                <i class="fas fa-lightbulb text-white" style="font-size:.85rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-700">{{ $chiefAdvisor->name ?? 'Chief Advisor' }}</h6>
                                <small class="text-muted">{{ $chiefAdvisor->position ?? 'Chief Advisor' }}</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left text-success opacity-25 fa-2x mb-2"></i>
                        <p class="text-muted mb-0" style="font-size:.93rem;line-height:1.7;">
                            {{ ($chiefAdvisor && $chiefAdvisor->description) ? Str::limit($chiefAdvisor->description, 200) : 'I urge each member to uphold the values of BESWA and be a beacon of change in your respective communities.' }}
                        </p>
                    </div>
                    <div class="px-4 pb-4">
                        <a href="{{ route('message') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Read Full Message</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ─────────────────────────────── OUR SERVICES ─────────────────────────────── --}}
@if($ourServices->count() > 0)
<section class="container my-5">
    <h2 class="section-title">Our Services</h2>
    <p class="section-subtitle">What we offer to our members and community</p>
    <div class="row g-4">
        @foreach($ourServices->take(6) as $service)
        <div class="col-lg-4 col-md-6">
            <div class="service-card">
                @if($service->icon)
                <i class="{{ $service->icon }}"></i>
                @else
                <i class="fas fa-cogs"></i>
                @endif
                <h4>{{ $service->title }}</h4>
                <p>{{ $service->sub_title }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ─────────────────────────────── OUR ACTIVITIES ─────────────────────────────── --}}
<section id="activities" class="container my-5">
    <h2 class="section-title">Our Activities</h2>
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
        <a href="{{ route('activities') }}" class="btn btn-primary-custom">View All Activities</a>
    </div>
    @endif
</section>

{{-- ─────────────────────────────── NEWS ─────────────────────────────── --}}
<section class="py-5" style="background:#f8faff;">
    <div class="container">
        <h2 class="section-title">Latest News</h2>
        <p class="section-subtitle">Stay updated with our latest stories and announcements</p>
        <div class="row g-4 mt-2">
            @forelse($latestBlogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden"
                     style="transition:transform .3s,box-shadow .3s;"
                     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,.12)'"
                     onmouseout="this.style.transform='';this.style.boxShadow=''">
                    @if($blog->image)
                    <img src="/{{ $blog->image }}" alt="{{ $blog->title }}"
                         class="card-img-top" style="height:200px;object-fit:cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center"
                         style="height:200px;background:linear-gradient(135deg,#667eea,#764ba2);">
                        <i class="fas fa-newspaper fa-3x text-white opacity-50"></i>
                    </div>
                    @endif
                    <div class="card-body p-4">
                        <span class="badge rounded-pill mb-2"
                              style="background:linear-gradient(135deg,#667eea,#764ba2);font-size:.75rem;">News</span>
                        <h5 class="card-title fw-bold mb-2" style="font-size:1.05rem;color:#1e293b;">
                            {{ $blog->title }}
                        </h5>
                        <p class="text-muted small mb-3" style="line-height:1.6;">
                            {{ $blog->excerpt ? Str::limit($blog->excerpt, 110) : Str::limit(strip_tags($blog->content ?? ''), 110) }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $blog->created_at->format('M d, Y') }}
                            </small>
                            <a href="{{ route('news') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted py-4">No news available at the moment.</p>
            </div>
            @endforelse
        </div>
        @if($latestBlogs->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('news') }}" class="btn btn-primary-custom">View All News</a>
        </div>
        @endif
    </div>
</section>

{{-- ─────────────────────────────── OUR CAMPUS ─────────────────────────────── --}}
<section class="my-5">
    <div class="container">
        <h2 class="section-title">Our Campus</h2>
        <p class="section-subtitle">A glimpse of the institution that shaped us all</p>
        <div class="row align-items-center g-5 mt-2">
            <div class="col-lg-6">
                <div class="position-relative">
                    @if(isset($aboutSetting) && $aboutSetting->image)
                    <img src="/{{ $aboutSetting->image }}" alt="BIMT Campus"
                         class="img-fluid rounded-4 shadow-lg" style="width:100%;height:380px;object-fit:cover;">
                    @else
                    <div class="rounded-4 shadow-lg d-flex align-items-center justify-content-center"
                         style="height:380px;background:linear-gradient(135deg,#667eea,#764ba2);">
                        <div class="text-center text-white">
                            <i class="fas fa-university fa-5x mb-3 opacity-75"></i>
                            <h4>BIMT Campus</h4>
                        </div>
                    </div>
                    @endif
                    <div class="position-absolute bottom-0 start-0 m-4 px-3 py-2 rounded-3 text-white"
                         style="background:rgba(0,0,0,.55);backdrop-filter:blur(4px);">
                        <small><i class="fas fa-map-marker-alt me-1"></i> Bangladesh Institute of Management and Technology</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge rounded-pill px-3 py-2 mb-3"
                      style="background:linear-gradient(135deg,#667eea,#764ba2);font-size:.8rem;">
                    <i class="fas fa-graduation-cap me-1"></i> Our Alma Mater
                </span>
                <h3 class="fw-bold mb-3" style="color:#1e293b;font-size:1.8rem;line-height:1.35;">
                    Bangladesh Institute of Management<br>& Technology (BIMT)
                </h3>
                <p class="text-muted mb-4" style="line-height:1.8;">
                    BIMT has been a cornerstone of technical and management education in Bangladesh. Through years of dedicated teaching and hands-on learning, this institution has produced thousands of skilled professionals who are now making their mark across various industries.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 rounded-3 text-center" style="background:#f0f4ff;border-left:4px solid #667eea;">
                            <div class="fw-bold" style="font-size:1.5rem;color:#667eea;">1000+</div>
                            <small class="text-muted">Alumni Members</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 text-center" style="background:#f0fdf4;border-left:4px solid #10b981;">
                            <div class="fw-bold" style="font-size:1.5rem;color:#10b981;">20+</div>
                            <small class="text-muted">Years of Excellence</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 text-center" style="background:#fff7ed;border-left:4px solid #f59e0b;">
                            <div class="fw-bold" style="font-size:1.5rem;color:#f59e0b;">50+</div>
                            <small class="text-muted">Intakes Completed</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 text-center" style="background:#fdf4ff;border-left:4px solid #a855f7;">
                            <div class="fw-bold" style="font-size:1.5rem;color:#a855f7;">10+</div>
                            <small class="text-muted">Departments</small>
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn btn-primary-custom">Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

{{-- ─────────────────────────────── PHOTO GALLERY ─────────────────────────────── --}}
<section id="gallery" class="py-5" style="background:#f8faff;">
    <div class="container">
        <h2 class="section-title">Photo Gallery</h2>
        <p class="section-subtitle">Glimpses of our work and activities</p>
        <div class="row g-3 mt-2">
            @forelse($photoGalleries as $photo)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="gallery-item">
                    @if($photo->image)
                        <img src="/{{ $photo->image }}" alt="Gallery" class="gallery-img">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image" class="gallery-img">
                    @endif
                    <div class="gallery-overlay">
                        <div class="gallery-badge">
                            <i class="fas fa-image"></i>
                            <span>Gallery</span>
                        </div>
                        <div class="gallery-zoom" aria-hidden="true">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No photos available in the gallery.</p>
            </div>
            @endforelse
        </div>
        @if($photoGalleries->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('gallery') }}" class="btn btn-primary-custom">View Full Gallery</a>
        </div>
        @endif
    </div>
</section>

{{-- ─────────────────────────────── CORE VALUES ─────────────────────────────── --}}
<section class="container my-5">
    <h2 class="section-title">Our Values</h2>
    <p class="section-subtitle">Principles that guide our work</p>
    <div class="row g-3">
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-white rounded-3 shadow-sm text-center">
                <div class="fw-bold">Volunteerism</div>
                <small class="text-muted">Serving with dedication</small>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-white rounded-3 shadow-sm text-center">
                <div class="fw-bold">Transparency</div>
                <small class="text-muted">Accountable and open</small>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-white rounded-3 shadow-sm text-center">
                <div class="fw-bold">Responsibility</div>
                <small class="text-muted">Collective action</small>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="p-3 bg-white rounded-3 shadow-sm text-center">
                <div class="fw-bold">Pride</div>
                <small class="text-muted">We are Proud BIMTian</small>
            </div>
        </div>
    </div>
</section>

{{-- ─────────────────────────────── ONLINE OFFICE ─────────────────────────────── --}}
<section class="office-section">
    <div class="container">
        <h2 class="section-title text-white">Connect With Us Online</h2>
        <p class="text-center mb-5">Register now to access all services online easily and conveniently</p>
        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-sm-12">
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

{{-- ─────────────────────────────── UPCOMING EVENTS ─────────────────────────────── --}}
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
        <a href="{{ route('events') }}" class="btn btn-primary-custom">View All Events</a>
    </div>
    @endif
</section>

{{-- ─────────────────────────────── CALL TO ACTION ─────────────────────────────── --}}
<section class="container my-5">
    <div class="p-4 bg-white rounded-3 shadow-sm text-center">
        <h3 class="mb-3">Get Involved</h3>
        <p class="mb-4">Join our community, volunteer your time, or support our initiatives to make a lasting impact.</p>
        <a href="{{ route('register') }}" class="btn btn-primary-custom me-2">Join BESWA</a>
        <a href="{{ route('donation.page') }}" class="btn btn-outline-custom">Donate</a>
    </div>
</section>

@endsection

@push('styles')
<style>
    #heroCarousel {
        width: 100%;
        overflow: hidden;
    }
    
    .carousel-inner,
    .carousel-item {
        width: 100%;
        height: 100%;
    }
    
    .hero-slide {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        min-height: 600px;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(#fff, rgba(130, 194, 255, 0.85));
        mix-blend-mode: multiply;
        z-index: 1;
    }
    
    .carousel-item {
        transition: transform 1s ease-in-out;
    }
    
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .carousel-fade .carousel-item.active {
        opacity: 1;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 20px;
    }
    
    .carousel-indicators {
        z-index: 3;
    }
    
    .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin: 0 4px;
    }
    
    .hero-content h1 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .hero-content p {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    @media (max-width: 768px) {
        .hero-slide {
            min-height: 400px;
        }
        
        .hero-content h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize carousel
    document.addEventListener('DOMContentLoaded', function() {
        var heroCarousel = document.getElementById('heroCarousel');
        if (heroCarousel) {
            new bootstrap.Carousel(heroCarousel, {
                interval: 5000,
                ride: 'carousel',
                pause: 'hover',
                wrap: true
            });
        }
    });
</script>
@endpush
