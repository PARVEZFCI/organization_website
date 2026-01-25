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
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
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
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activities">Activities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('teams') }}">Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/donation') }}">Donation</a></li>
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
                    <p>{{ isset($settings) && $settings->company_name ? $settings->company_name . ' - is a voluntary organization in Matiranga dedicated to social welfare, skill development, and creating a drug-free, enlightened society.' : 'Dream Youth Club is a voluntary organization in Matiranga dedicated to social welfare, skill development, and creating a drug-free, enlightened society.' }}</p>
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
                <p>&copy; {{ date('Y') }} {{ isset($settings) && $settings->company_name ? $settings->company_name : 'Dream Youth Club' }}. All Rights Reserved.
                    | Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for Students
                </p>
            </div>
        </div>
    </footer>



    @yield('scripts')
</body>


</html>
