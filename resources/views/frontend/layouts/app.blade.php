<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $settings = DB::table('settings')->orderBy('id','DESC')->first();
        $ourServices = \App\Models\OurService::latest()->limit(6)->get();
    @endphp
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
    <script src="{{ asset('frontend/main.js') }}" defer></script>
    @yield('styles')

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                @if(isset($settings) && $settings->logo)
                <img src="{{ url($settings->logo) }}" alt="{{ $settings->company_name ?? 'Logo' }}">
                @else
                <img src="{{ url('img/DYC Circle Logo with Border.png') }}" alt="Logo">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>

                    <!-- About Link -->
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}" href="{{ route('events') }}">Events</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('activities') ? 'active' : '' }}" href="{{ route('activities') }}">Our Activities</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>

                    <!-- Committee Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('executive-committee') || request()->routeIs('advisory-council') ? 'active' : '' }}" href="#" id="committeeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Committee
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="committeeDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('executive-committee') ? 'active' : '' }}" href="{{ route('executive-committee') }}">Executive Committee</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('advisory-council') ? 'active' : '' }}" href="{{ route('advisory-council') }}">Advisory Council</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('donation.page') ? 'active' : '' }}" href="{{ route('donation.page') }}">Donation</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
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
                    <a href="#">Contact</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">FAQs</a>
                    <a href="#">Careers</a>
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
</body>


</html>
