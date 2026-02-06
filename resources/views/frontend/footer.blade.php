  <!-- footer start -->
    @php
        $settings = DB::table('settings')->orderBy('id','DESC')->first();
    @endphp
    <footer id="Contact">
        <div class="footer-area primary-bg pt-150">
            <div class="container">
                <div class="footer-top pb-35">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-logo">
                                    @if(isset($settings) && $settings->logo)
                                    <img src="{{ url($settings->logo) }}" alt="{{ $settings->company_name ?? 'Company Logo' }}" class="img-fluid">
                                    @else
                                    <img src="img/mytech.jpg" alt="" class="img-fluid">
                                    @endif
                                </div>
                                <div class="footer-para">
                                    @if(isset($settings) && $settings->company_name)
                                    <p>{{ $settings->company_name }} - is a voluntary, non-profit alumni organization supporting BIMT students and graduates through welfare, education, professional growth, and social development initiatives.</p>
                                    @else
                                    <p>Sorem ipsum dolor sit amet conse ctetur adipiscing elit, sed do eiusmod incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nostrud exercition ullamco laboris nisi </p>
                                    @endif
                                </div>
                                <div class="footer-socila-icon">
                                    <span>Follow Us</span>
                                    <div class="footer-social-icon-list">
                                        <ul>
                                            <li><a href="#"><span class="ti-facebook"></span></a></li>
                                            <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                                            <li><a href="#"><span class="ti-dribbble"></span></a></li>
                                            <li><a href="#"><span class="ti-google"></span></a></li>
                                            <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                            <li><a href="#"><span class="ti-instagram"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-heading">
                                    <h1>Quick Links</h1>
                                </div>
                                <div class="footer-menu clearfix">
                                    <ul>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Condition</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Consultation</a></li>
                                        <li><a href="#">Team Member</a></li>
                                        <li><a href="#">Our Services</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Who we are</a></li>
                                        <li><a href="#">Get a Quote</a></li>
                                        <li><a href="#">Recent Post</a></li>
                                        <li><a href="#">Who we are</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 d-lg-none d-xl-block col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-heading">
                                    <h1>Recent Post</h1>
                                </div>
                                <div class="recent-post d-flex mb-25">
                                    <div class="recent-post-thumb">
                                        <img src="img/post/recent_post1.jpg" alt="">
                                    </div>
                                    <div class="recent-post-text">
                                        <p>Neque porro quisquam est qui dolorem ipsum</p>
                                        <div class="footer-time">
                                            <span class="ti-time"></span>
                                            <span class="footer-published-time">05 May 2018</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="recent-post d-flex">
                                    <div class="recent-post-thumb">
                                        <img src="img/post/recent_post1.jpg" alt="">
                                    </div>
                                    <div class="recent-post-text">
                                        <p>Neque porro quisquam est qui dolorem ipsum</p>
                                        <div class="footer-time">
                                            <span class="ti-time"></span>
                                            <span class="footer-published-time">05 May 2018</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4  col-md-6">
                            <div class="footer-widget mb-30">
                                <div class="footer-heading">
                                    <h1>Contact Us</h1>
                                </div>
                                <div class="footer-contact-list">
                                    @if(isset($settings) && $settings->phone)
                                    <div class="single-footer-contact-info">
                                        <span class="ti-headphone "></span>
                                        <span class="footer-contact-list-text">{{ $settings->phone }}</span>
                                    </div>
                                    @else
                                    <div class="single-footer-contact-info">
                                        <span class="ti-headphone "></span>
                                        <span class="footer-contact-list-text">+003 (1234) 7894</span>
                                    </div>
                                    @endif

                                    @if(isset($settings) && $settings->email)
                                    <div class="single-footer-contact-info">
                                        <span class="ti-email "></span>
                                        <span class="footer-contact-list-text">{{ $settings->email }}</span>
                                    </div>
                                    @else
                                    <div class="single-footer-contact-info">
                                        <span class="ti-email "></span>
                                        <span class="footer-contact-list-text">youremail@gmail.com</span>
                                    </div>
                                    @endif

                                    @if(isset($settings) && $settings->address)
                                    <div class="single-footer-contact-info">
                                        <span class="ti-location-pin"></span>
                                        <span class="footer-contact-list-text">{{ $settings->address }}</span>
                                    </div>
                                    @else
                                    <div class="single-footer-contact-info">
                                        <span class="ti-location-pin"></span>
                                        <span class="footer-contact-list-text">123 New Street, 6th Floor, New York</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="opening-time">
                                    <span>Opening Hour</span>
                                    <span class="opening-date">
                                        Sun - Sat : 10:00 am - 05:00 pm
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
