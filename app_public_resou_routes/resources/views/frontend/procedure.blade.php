   @extends('frontend.layouts.app')

@section('title', 'Courses - Training Center')

@section('content')
   
   <!-- slider-start -->
    <div class="slider-area">
        <div class="pages-title">
            <div class="single-slider slider-height slider-height-breadcrumb d-flex align-items-center" style="background-image: url(img/bg/others_bg.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider-content slider-content-breadcrumb text-center">
                                <h1 class="white-color f-700">Procedure</h1>
                                <nav class="text-center" aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Procedure</li>
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

    <!-- procedure start -->
    <div class="page-banner contact-page">
        <div class="container py-5">
            <div class="row m-lr0" style="justify-content: center;">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <img src="https://jes-bd.com/public/images/procedures.png" height="500px;">
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 pl-5">
                    <div class="heading-bx left">
                        <h2 class="title-head">Require Documents</h2>
                    </div>
                    <h5 class="text-left">Student Documents</h5>
                    <ul class="list">
                        <li>Passport</li>
                        <li>Photo (4cmx3cm) 4 Copy</li>
                        <li>SSC Certificate &amp; Marksheet</li>
                        <li>HSC Certificate &amp; Marksheet</li>
                        <li>Birth Certificate / NID</li>
                        <li>Graduation Certificate &amp; Marksheet (Testimonial for Running Student)</li>
                        <li>Job Experience Certificate (if any)</li>
                        <li>Language Course Certificate  (NAT/JLPT)</li>
                    </ul>
                    <h5 class="text-left mt-4">Sponsors Documents</h5>
                    <ul class="list">
                        <li>Sponsors Photo (4.5cmx5.5cm) 2 Copy</li>
                        <li>NID Copy</li>
                        <li>Trade License / Job Certificate</li>
                        <li>Bank Statement &amp; Solvency</li>
                        <li>Annual Income &amp; Tax Certificate</li>
                        <li>Family Certificate</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- procedure end -->

@endsection
    