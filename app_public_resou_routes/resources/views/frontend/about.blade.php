@extends('frontend.layouts.app')

@section('title', 'About Us - Training Center')

@section('content')
    <!-- slider-start -->
    <div class="slider-area">
        <div class="page-title">
            <div class="single-slider slider-height slider-height-breadcrumb d-flex align-items-center"
                style="background-image: url(img/bg/others_bg.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider-content slider-content-breadcrumb text-center">
                                <h1 class="white-color f-700">About Us</h1>
                                <nav class="text-center" aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-end -->

    <!-- message start -->
    <div class="section-area bg-white section-sp1 ">
        <div class="container ">
            <div class="row align-items-center d-flex ">

                <div class="col-lg-12 col-md-12 heading-bx">
                    <h2 class="m-b10 p-3">Message From The Managing Director</h2>
                    <div class="px-3 mt-5 row ">
                        <!-- Image Section -->
                        <div class="col-12 col-md-2 text-center mb-md-0">
                            <img src="./img/WhyUs/student1.jpg" alt="Md Ali Hasan" class="img-fluid rounded-circle shadow"
                                style="max-width: 120px;">
                        </div>

                        <!-- Text Section -->
                        <div class="col-12 col-md-9">
                            {!! $aboutSetting && $aboutSetting->director_message ? $aboutSetting->director_message : '<p class="mb-3">I hope this message finds you in good spirits. My name is <strong>Md Ali Hasan</strong>, and I represent <strong>Japan Education Service</strong>, a Japanese language institute located in Bangladesh. Since our establishment in 2015, we have been dedicated to providing exceptional language training and assisting students with their visa applications.</p>' !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- message end -->

    <!-- story strat -->
    <div class="section-area bg-gray section-sp1 ">
        <div class="container bg-gray">
            <div class="row align-items-center d-flex">
                <div class="col-lg-12 col-md-12 heading-bx">
                    <h2 class="m-b10">Our Story</h2>
                    <p>Japan Education Service was started on 2015. It was established as a Language Training Institute. We
                        focus on Japanese Language Training and VISA Processing. We are based in Bangladesh. We works with
                        Many Japanese Language Institute.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- story end -->

    <!-- about start -->
    <div id="about" class="about-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7">
                    <div class="about-img mb-30">
                        <img src="./img/about/icon1.png" alt="">
                    </div>
                    <div class="about-title-section about-title-section-2 mb-30">
                        <h1>Who We Are</h1>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                            dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                            fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia
                            non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut
                            enim ad miniveniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
                            aliquid ex ea consequatur? Quis autem vel eum iure reprehenderit.</p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="about-img mb-55">
                        <img src="./img/about/icon2.png" alt="">
                    </div>
                    <div class="about-title-section about-title-section-2 mb-30">
                        <h1>Our MIssion Vission</h1>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptat accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                            dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                            fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur adipisci velit.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-xl-12">
                    <div class="university-banner mb-30">
                        <img src="img/about/university.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about end -->

    <!-- counter start -->
    <div class="counter-area primary-bg">
        <div class="container pt-90 pb-65">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="couter-wrapper couter-wrapper-2 mb-30 text-center">
                        <img src="img/counter/counter_icon1.png" alt="">
                        <span class="counter">10532</span>
                        <h3>Satisfied Students</h3>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="couter-wrapper couter-wrapper-2 mb-30 text-center">
                        <img src="img/counter/counter_icon2.png" alt="">
                        <span class="counter">7985</span>
                        <h3>Courses Complated</h3>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="couter-wrapper couter-wrapper-2 mb-30 text-center">
                        <img src="img/counter/counter_icon3.png" alt="">
                        <span class="counter">5382</span>
                        <h3>Satisfied Students</h3>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="couter-wrapper couter-wrapper-2 mb-30 text-center">
                        <img src="img/counter/counter_icon4.png" alt="">
                        <span class="counter">354</span>
                        <h3>Expert Advisors</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter end -->

    <!-- testimonials start -->
    <div class="testimonilas-area pt-100 pb-90 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">What Our Students Say</h1>
                        </div>
                        <div class="section-title-para">
                            <p class="gray-color">Belis nisl adipiscing sapien sed malesu diame lacus eget erat Cras mollis
                                scelerisqu Nullam arcu liquam here was consequat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonilas-list">
                <div class="row testimonilas-active">
                    <div class="col-xl-12">
                        <div class="testimonilas-wrapper mb-110">
                            <div class="testimonilas-heading d-flex">
                                <div class="testimonilas-author-thumb">
                                    <img src="img/testimonials/testimonilas_author_thumb1.png" alt="">
                                </div>
                                <div class="testimonilas-author-title">
                                    <h1>Lisa McClanahan</h1>
                                    <h2>CSE Student</h2>
                                </div>
                            </div>
                            <div class="testimonilas-para">
                                <p>But also the leap into electronic type reman see essentially unchanged. It was popul
                                    arised thew with the release of letraset sheets.</p>
                            </div>
                            <div class="testimonilas-rating">
                                <ul>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="testimonilas-wrapper">
                            <div class="testimonilas-heading d-flex">
                                <div class="testimonilas-author-thumb">
                                    <img src="img/testimonials/testimonilas_author_thumb1.png" alt="">
                                </div>
                                <div class="testimonilas-author-title">
                                    <h1>Lisa McClanahan</h1>
                                    <h2>CSE Student</h2>
                                </div>
                            </div>
                            <div class="testimonilas-para">
                                <p>But also the leap into electronic type reman see essentially unchanged. It was popul
                                    arised thew with the release of letraset sheets.</p>
                            </div>
                            <div class="testimonilas-rating">
                                <ul>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="testimonilas-wrapper">
                            <div class="testimonilas-heading d-flex">
                                <div class="testimonilas-author-thumb">
                                    <img src="img/testimonials/testimonilas_author_thumb2.png" alt="">
                                </div>
                                <div class="testimonilas-author-title">
                                    <h1>Trevor J. Angelo</h1>
                                    <h2>Englisg Student</h2>
                                </div>
                            </div>
                            <div class="testimonilas-para">
                                <p>But also the leap into electronic type reman see essentially unchanged. It was popul
                                    arised thew with the release of letraset sheets.</p>
                            </div>
                            <div class="testimonilas-rating">
                                <ul>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="testimonilas-wrapper">
                            <div class="testimonilas-heading d-flex">
                                <div class="testimonilas-author-thumb">
                                    <img src="img/testimonials/testimonilas_author_thumb1.png" alt="">
                                </div>
                                <div class="testimonilas-author-title">
                                    <h1>Marquita Brown</h1>
                                    <h2>CSE Student</h2>
                                </div>
                            </div>
                            <div class="testimonilas-para">
                                <p>But also the leap into electronic type reman see essentially unchanged. It was popul
                                    arised thew with the release of letraset sheets.</p>
                            </div>
                            <div class="testimonilas-rating">
                                <ul>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection