<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empowering Youth, Building the Future</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="icon"  href="{{ url('Fav Icon.png') }}">
    <script src="{{ asset('frontend/main.js') }}" defer></script>
    @yield('styles')

</head>

<body>
  @php
         $data = DB::table('settings')->orderBy('id','DESC')->first();

    @endphp
     <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{url($data->logo)}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activities">Activities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
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
            <div class="row justify-content-center mt-4">
                <div class="col-lg-6 col-md-8">
                    <div class="input-group">
                        <input type="email" class="form-control newsletter-input" placeholder="Enter your email address">
                        <button class="btn newsletter-btn">Subscribe</button>
                    </div>
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
                        <img src="img/DYC Circle Logo with Border.png" alt="">
                    </div>
                    <p>We are a dedicated organization committed to farmers' development, providing modern technology and comprehensive services</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Services</h5>
                    <a href="#">Fish Farming</a>
                    <a href="#">Agricultural Consultation</a>
                    <a href="#">Technology Support</a>
                    <a href="#">Training Programs</a>
                    <a href="#">Pest Control</a>
                    <a href="#">Seed Distribution</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <a href="#">About Us</a>
                    <a href="#">Contact</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">FAQs</a>
                    <a href="#">Careers</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Agriculture Road, Dhaka, Bangladesh</p>
                    <p><i class="fas fa-phone"></i> +880 1234-567890</p>
                    <p><i class="fas fa-envelope"></i> info@agriserve.gov.bd</p>
                    <p><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 5:00 PM</p>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>&copy; 2025 Dream Youth Club. All Rights Reserved.
                    | Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for Students
                </p>
            </div>
        </div>
    </footer>



    @yield('scripts')
</body>


</html>
