<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', isset($settings) && $settings->company_name ? $settings->company_name : 'Empowering Youth, Building the Future')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    @if(isset($settings) && $settings->favicon)
    <link rel="icon" href="{{ url($settings->favicon) }}">
    @else
    <link rel="icon" href="{{ url('Fav Icon.png') }}">
    @endif
    @stack('styles')
    <script src="{{ asset('frontend/main.js') }}" defer></script>
    @yield('styles')

</head>

<body>
    <!-- Header Top Section -->
    <header class="header-top">
        <div class="container">
            <div class="header-content">
                <a href="{{ url('/') }}" class="logo-section">
                    @if(isset($settings) && $settings->logo)
                    <img src="{{ url($settings->logo) }}" alt="{{ $settings->company_name ?? 'Logo' }}" class="logo-img">
                    @else
                    <img src="{{ asset('img/DYC Circle Logo with Border.png') }}" alt="Logo" class="logo-img">
                    @endif
                    <div class="organization-names">
                        <p class="org-name-bn">{{ $settings->company_name_bn ?? 'বিআইএমটি এক্স-স্টুডেন্টস ওয়েলফেয়ার অ্যাসোসিয়েশন' }}</p>
                        <p class="org-name-en">{{ $settings->company_name ?? 'BIMT Ex-Students Welfare Association' }}</p>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('about') || request()->routeIs('about.*') || request()->routeIs('message') ? 'active' : '' }}" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('about.mission-vision') ? 'active' : '' }}" href="{{ route('about.mission-vision') }}">Mission & Vision</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('about.aims-objectives') ? 'active' : '' }}" href="{{ route('about.aims-objectives') }}">Aims & Objectives</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('message') ? 'active' : '' }}" href="{{ route('message') }}">Leadership Message</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}" href="{{ route('events') }}">Events</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('activities') ? 'active' : '' }}" href="{{ route('activities') }}">Our Activities</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('membership.form') || request()->routeIs('memberships.*') ? 'active' : '' }}" href="#" id="membershipDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Family/Membership
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="membershipDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('memberships.founder') ? 'active' : '' }}" href="{{ route('memberships.founder') }}">Founder Members</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('memberships.general') ? 'active' : '' }}" href="{{ route('memberships.general') }}">General Members</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('memberships.life') ? 'active' : '' }}" href="{{ route('memberships.life') }}">Life Members</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('memberships.associate') ? 'active' : '' }}" href="{{ route('memberships.associate') }}">Associate Members</a></li>
                        </ul>
                    </li>

                    <!-- Committee Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('executive-committee') || request()->routeIs('past-leaders') || request()->routeIs('advisory-council') ? 'active' : '' }}" href="#" id="committeeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Leadership
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="committeeDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('executive-committee') ? 'active' : '' }}" href="{{ route('executive-committee') }}">Executive Committee</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('advisory-council') ? 'active' : '' }}" href="{{ route('advisory-council') }}">Advisory Council</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('past-leaders') ? 'active' : '' }}" href="{{ route('past-leaders') }}">Past Leaders</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('donation.page') ? 'active' : '' }}" href="{{ route('donation.page') }}">Donation</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                    @if(Auth::guard('member')->check())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.*') ? 'active' : '' }}" href="{{ route('member.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>My Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.login') ? 'active' : '' }}" href="{{ route('member.login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Member Login
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>



       <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container text-center">
            <h3>Subscribe for Regular Updates</h3>
            <p class="mt-3">Subscribe to our newsletter and stay informed about the latest news and updates</p>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->has('email'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ $errors->first('email') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row justify-content-center mt-4">
                <div class="col-lg-6 col-md-8">
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                            <button type="submit" class="btn newsletter-btn">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="logo">
                        @if(isset($settings) && $settings->logo)
                        <img src="{{ url($settings->logo) }}" alt="{{ $settings->company_name ?? 'Logo' }}">
                        @else
                        <img src="img/DYC Circle Logo with Border.png" alt="">
                        @endif
                    </div>
                    <p>{{ isset($settings) && $settings->company_name ? $settings->company_name . ' - is a voluntary, non-profit alumni organization supporting BIMT students and graduates through welfare, education, professional growth, and social development initiatives.' : 'BESWA is a voluntary, non-profit alumni organization supporting BIMT students and graduates through welfare, education, professional growth, and social development initiatives.' }}</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Services</h5>
                    @forelse($ourServices as $service)
                    <a href="#">{{ $service->title }}</a>
                    @empty
                    <a href="#">Fish Farming</a>
                    <a href="#">Agricultural Consultation</a>
                    <a href="#">Technology Support</a>
                    @endforelse
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <a href="{{ route('about') }}">About Us</a>
                    <a href="{{ route('about.mission-vision') }}">Mission & Vision</a>
                    <a href="{{ route('about.aims-objectives') }}">Aims & Objectives</a>
                    <a href="#">Contact</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    @if(isset($settings) && $settings->address)
                    <p><i class="fas fa-map-marker-alt"></i> {{ $settings->address }}</p>
                    @else
                    <p><i class="fas fa-map-marker-alt"></i> 123 Agriculture Road, Dhaka, Bangladesh</p>
                    @endif

                    @if(isset($settings) && $settings->phone)
                    <p><i class="fas fa-phone"></i> {{ $settings->phone }}</p>
                    @else
                    <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                    @endif

                    @if(isset($settings) && $settings->email)
                    <p><i class="fas fa-envelope"></i> {{ $settings->email }}</p>
                    @else
                    <p><i class="fas fa-envelope"></i> info@agriserve.gov.bd</p>
                    @endif

                    {{-- <p><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 5:00 PM</p> --}}
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>&copy; {{ date('Y') }} {{ isset($settings) && $settings->company_name ? $settings->company_name : 'BESWA' }}. All Rights Reserved.
                    | Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for Volunteries
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
    @stack('scripts')
</body>


</html>
