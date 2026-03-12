@extends('frontend.layouts.app')

@section('title', 'Home - BESWA')

@section('content')
@php
$homeSettings = \App\Models\HomeSetting::first();
$pinnedNews = \App\Models\Blog::where('is_pinned', true)->where('status', 'published')->latest()->get();
$pinnedEvents = \App\Models\UpcomingEvent::where('is_pinned', true)->latest()->get();
$marqueeItems = $pinnedNews->concat($pinnedEvents)->shuffle();
@endphp

{{-- ─────────────────────────────── HERO ─────────────────────────────── --}}

@if($marqueeItems->count() > 0)
<!-- News & Events Marquee -->
<div class="news-marquee">
    <div class="marquee-container">
        <div class="marquee-icon">
            <i class="fas fa-bullhorn"></i>
            <span>Latest Updates</span>
        </div>
        <div class="marquee-content">
            <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($marqueeItems as $item)
                    <span class="marquee-item">
                        @if($item instanceof \App\Models\Blog)
                            <i class="fas fa-newspaper text-primary"></i> <strong>News:</strong> {{ $item->title }}
                        @else
                            <i class="fas fa-calendar-alt text-danger"></i> <strong>Event:</strong> {{ $item->title }}
                            @if($item->date)
                                ({{ $item->date->format('M d, Y') }})
                            @endif
                        @endif
                    </span>
                    <span class="marquee-separator">•</span>
                @endforeach
            </marquee>
        </div>
    </div>
</div>
@endif

<section id="home" class="hero-section p-0">
    <div class="hero-slide" style="background: linear-gradient(#fff, rgba(130, 194, 255, 0.85)), url('{{ asset($homeSettings->banner_image) }}');">
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
</section>


@if(isset($pinnedPhotos) && $pinnedPhotos->count() > 0)
<section class="hero-pinned-section py-3 py-md-4">
    <div class="container">
        <!-- Desktop Grid View -->
        <div class="hero-pinned-grid d-none d-md-block">
            <div class="row g-3">
                @foreach($pinnedPhotos->take(6) as $photo)
                    <div class="col-2">
                        <div class="hero-pinned-item">
                            <img src="/{{ $photo->image }}" alt="Pinned photo">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Carousel -->
        <div id="heroPinnedCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($pinnedPhotos->take(6) as $index => $photo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-pinned-mobile-item">
                            <img src="/{{ $photo->image }}" alt="Pinned photo {{ $index + 1 }}">
                        </div>
                    </div>
                @endforeach
            </div>
            @if($pinnedPhotos->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroPinnedCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroPinnedCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>
@elseif(isset($photoGalleries) && $photoGalleries->count() > 0)
<section class="hero-pinned-section d-md-none mt-5 py-3 py-md-4">
    <div class="container">
        <!-- Desktop Grid View - Fallback to regular gallery -->
        <div class="hero-pinned-grid d-none d-md-block">
            <div class="row g-3">
                @foreach($photoGalleries->take(6) as $photo)
                    <div class="col-2">
                        <div class="hero-pinned-item">
                            <img src="/{{ $photo->image }}" alt="Gallery photo">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Carousel - Fallback to regular gallery -->
        <div id="heroPinnedCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($photoGalleries->take(6) as $index => $photo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-pinned-mobile-item">
                            <img src="/{{ $photo->image }}" alt="Gallery photo {{ $index + 1 }}">
                        </div>
                    </div>
                @endforeach
            </div>
            @if($photoGalleries->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroPinnedCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroPinnedCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>
@endif

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

            @forelse($leadershipMessages as $index => $leader)
                @php
                    $colors = [
                        ['bg' => 'linear-gradient(135deg,#667eea,#764ba2)', 'btn' => 'primary', 'icon' => 'star'],
                        ['bg' => 'linear-gradient(135deg,#0ea5e9,#0284c7)', 'btn' => 'info', 'icon' => 'pen-nib'],
                        ['bg' => 'linear-gradient(135deg,#10b981,#059669)', 'btn' => 'success', 'icon' => 'lightbulb'],
                        ['bg' => 'linear-gradient(135deg,#f59e0b,#d97706)', 'btn' => 'warning', 'icon' => 'handshake'],
                        ['bg' => 'linear-gradient(135deg,#ef4444,#dc2626)', 'btn' => 'danger', 'icon' => 'heart'],
                    ];
                    $colorIndex = $index % count($colors);
                    $color = $colors[$colorIndex];
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="p-0">
                            @if($leader->image)
                                <img src="{{ asset($leader->image) }}" alt="{{ $leader->name }}"
                                     class="w-100" style="height: 240px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center"
                                     style="height:240px; background: {{ $color['bg'] }};">
                                    <i class="fas fa-user-tie fa-4x text-white opacity-75"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                     style="width:42px;height:42px;background:{{ $color['bg'] }};">
                                    <i class="fas fa-{{ $color['icon'] }} text-white" style="font-size:.85rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-700">{{ $leader->name }}</h6>
                                    <small class="text-muted">{{ $leader->designation }}</small>
                                </div>
                            </div>
                            <i class="fas fa-quote-left text-{{ $color['btn'] }} opacity-25 fa-2x mb-2"></i>
                            <p class="text-muted mb-0" style="font-size:.93rem;line-height:1.7;">
                                {{ Str::limit($leader->message, 200) }}
                            </p>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="{{ route('message') }}" class="btn btn-sm btn-outline-{{ $color['btn'] }} rounded-pill px-3">Read Full Message</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No leadership messages available at the moment.</p>
                </div>
            @endforelse

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
                    @if(isset($aboutSetting) && $aboutSetting->campus_image)
                    <img src="/{{ $aboutSetting->campus_image }}" alt="{{ $aboutSetting->campus_title ?? 'Campus' }}"
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
                        <small><i class="fas fa-map-marker-alt me-1"></i> {{ $aboutSetting->campus_title ?? 'Bangladesh Institute of Management and Technology' }}</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge rounded-pill px-3 py-2 mb-3"
                      style="background:linear-gradient(135deg,#667eea,#764ba2);font-size:.8rem;">
                    <i class="fas fa-graduation-cap me-1"></i> Our Alma Mater
                </span>
                <h3 class="fw-bold mb-3" style="color:#1e293b;font-size:1.8rem;line-height:1.35;">
                    {{ $aboutSetting->campus_title ?? 'Bangladesh Institute of Management & Technology (BIMT)' }}
                </h3>
                <p class="text-muted mb-4" style="line-height:1.8;">
                    {{ $aboutSetting->campus_description ?? 'BIMT has been a cornerstone of technical and management education in Bangladesh. Through years of dedicated teaching and hands-on learning, this institution has produced thousands of skilled professionals who are now making their mark across various industries.' }}
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

{{-- ─────────────────────────────── CONSTITUTION ─────────────────────────────── --}}
@if(isset($constitution) && ($constitution->file_path || $constitution->content))
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 rounded-3 shadow-sm text-center">
                <i class="fas fa-file-pdf" style="font-size: 4rem; color: #dc2626; margin-bottom: 1.5rem;"></i>
                <h3 class="mb-3" style="color: #1e40af; font-weight: 600;">{{ $constitution->title ?? 'BESWA Constitution' }}</h3>
                
                @if($constitution->content)
                <div class="mb-4 text-start" style="color: #64748b; line-height: 1.8;">
                    {!! Str::limit(strip_tags($constitution->content), 200) !!}
                </div>
                @else
                <p class="mb-4" style="color: #64748b; line-height: 1.8;">
                    Read our official constitution document to learn more about BESWA's structure, rules, regulations, and governance framework.
                </p>
                @endif
                
                @if($constitution->file_path)
                    @if($constitution->file_type == 'pdf')
                        <a href="{{ asset($constitution->file_path) }}" download class="btn btn-primary btn-lg" style="background: #3b82f6; border: none; padding: 12px 40px; border-radius: 8px;">
                            <i class="fas fa-download me-2"></i>Download Constitution (PDF)
                        </a>
                    @elseif($constitution->file_type == 'image')
                        <div class="mb-3">
                            <img src="{{ asset($constitution->file_path) }}" alt="{{ $constitution->title }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 500px;">
                        </div>
                        <a href="{{ asset($constitution->file_path) }}" download class="btn btn-primary btn-lg" style="background: #3b82f6; border: none; padding: 12px 40px; border-radius: 8px;">
                            <i class="fas fa-download me-2"></i>Download Image
                        </a>
                    @endif
                @endif
                
                <p class="mt-3 mb-0 small text-muted">
                    <i class="fas fa-info-circle me-1"></i>Last Updated: {{ $constitution->updated_at ? $constitution->updated_at->format('F Y') : 'Recently' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endif

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
    
    .hero-content h1 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .hero-content p {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .hero-pinned-section {
        background: #f8faff;
    }

    .hero-pinned-item {
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
        border: 1px solid rgba(148, 163, 184, 0.22);
        height: 100%;
    }

    .hero-pinned-item img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        display: block;
    }

    .hero-pinned-mobile-item {
        margin: 0 auto;
        width: min(92%, 380px);
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
        border: 1px solid rgba(148, 163, 184, 0.22);
    }

    .hero-pinned-mobile-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    #heroPinnedCarousel {
        position: relative;
    }

    #heroPinnedCarousel .carousel-control-prev,
    #heroPinnedCarousel .carousel-control-next {
        width: 50px;
    }

    #heroPinnedCarousel .carousel-control-prev-icon,
    #heroPinnedCarousel .carousel-control-next-icon {
        background-color: rgba(15, 23, 42, 0.6);
        border-radius: 50%;
        padding: 18px;
        width: 40px;
        height: 40px;
    }

    #heroPinnedCarousel .carousel-item {
        transition: transform 0.6s ease-in-out;
    }
    
    @media (max-width: 768px) {
        .hero-slide {
            min-height: 400px;
        }
        
        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile pinned photos carousel auto-play
        var heroPinnedCarousel = document.getElementById('heroPinnedCarousel');
        if (heroPinnedCarousel) {
            var carousel = new bootstrap.Carousel(heroPinnedCarousel, {
                interval: 3000,
                ride: 'carousel',
                pause: 'hover',
                wrap: true,
                touch: true
            });
        }
    });
</script>
@endpush
