@extends('frontend.layouts.app')

@section('title', 'Courses - Training Center')

@section('content')

    <div class="course-details-area gray-bg pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="single-course-details-area mb-30">
                        <div class="course-details-thumb">
                            <img src="{{ $course->banner_image ? asset($course->banner_image) : asset('frontend/img/courses/course_details_thumb.jpg') }}"
                                alt="{{ $course->name }}">
                        </div>
                        <div class="single-course-details white-bg">
                            <div class="course-details-title mb-20">
                                <h1>{{ $course->name }}</h1>
                            </div>
                            <div class="course-details-tabs">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                            role="tab" aria-controls="pills-home" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                            role="tab" aria-controls="pills-profile" aria-selected="false">Curriculum</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                            role="tab" aria-controls="pills-contact" aria-selected="false">Advisor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews"
                                            role="tab" aria-controls="pills-contact" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="course-details-overview-top">
                                            <p class="course-details-overview-para">{!! $course->overview !!}</p>
                                            <p>No one rejects, dislikes, or avoids pleasure itself because it is pleasure,
                                                but because those who do not know how to pursue pleasure rationally
                                                encounter consequences that are extremely painful. Nor again is there anyone
                                                who loves expound the actual teachings of the grex plore.</p>
                                        </div>
                                        <div class="course-details-overview-bottom d-flex justify-content-between mt-25">
                                            <div class="course-overview-info-left">
                                                <div class="course-overview-info-advisor mt-10">
                                                    <span class="gray-color">Advisor : <span
                                                            class="primary-color">{{ $course->advisor }}</span></span>
                                                </div>
                                                <div class="course-overview-student-lecture mt-10">
                                                    <span class="gray-color">Students : <span
                                                            class="primary-color">{{ $course->student }}</span></span>
                                                    <span class="student-lecture-number gray-color">Lectures: <span
                                                            class="primary-color">{{ $course->lecture }}</span></span>
                                                </div>
                                                <div class="course-overview-time-delay mt-10">
                                                    <span class="gray-color">Time : <span
                                                            class="primary-color">{{ $course->time }}</span></span>
                                                </div>
                                            </div>
                                            <div class="course-overview-info-right">
                                                <div class="course-overview-info-category mt-10">
                                                    <span class="gray-color">Category :<span class="primary-color">
                                                            {{ $course->category ? $course->category->name : '' }}</span></span>
                                                </div>
                                                <div class="course-overview-info-tag mt-10">
                                                    <span class="gray-color">Tags : <span class="primary-color"> Web
                                                            Development,</span> Layout</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <p class="course-details-curiculum-para">{!! $course->curriculum !!}</p>
                                        <div class="curiculum-lecture-details">
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.1</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 30 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="single-curiculum-lecture table-responsive mt-10">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="ti-book"></span>
                                                                <span class="chapter-name">Lecture 1.2</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-timer "></span>
                                                                <span class="chapter-name">Time : 20 Minute</span>
                                                            </td>
                                                            <td>
                                                                <span class="ti-user"></span>
                                                                <span class="chapter-name">Seat : 25</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab">
                                        <div class="course-details-adivisor-info mt-30">
                                            <div class="course-details-adivisor-wrapper">
                                                <div class="course-details-adivisor-inner d-flex">
                                                    <div class="adivisor-thumb">
                                                        <img src="img/courses/advisors_thumb.jpg" alt="">
                                                    </div>
                                                    <div class="adivisor-text white-bg">
                                                        <div class="adivisor-text-heading d-flex mb-10">
                                                            <div class="adivisor-text-title">
                                                                <h4>Alexzender Alex</h4>
                                                                <span>CSE Teacher</span>
                                                            </div>
                                                        </div>
                                                        <div class="adivisor-para">
                                                            <p>Sed ut perspiciatis unde omnis iste natus error sit
                                                                voluptatem accusa dolore mque laudantium totam rem aperiam
                                                                eaqipsa quae ab illo inventore veritatvolup tatem quia
                                                                voluptas sit aspernatur aut odit aut fugit sed quia
                                                                conseque.</p>
                                                        </div>
                                                        <div class="advisors-social-icon-list">
                                                            <ul>
                                                                <li><a href="#"><span class="ti-facebook"></span></a></li>
                                                                <li><a href="#"><span class="ti-twitter-alt"></span></a>
                                                                </li>
                                                                <li><a href="#"><span class="ti-dribbble"></span></a></li>
                                                                <li><a href="#"><span class="ti-google"></span></a></li>
                                                                <li><a href="#"><span class="ti-pinterest"></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel"
                                        aria-labelledby="pills-reviews-tab">
                                        <div class="course-details-reviews mt-30">
                                            <div class="cours-reviews-list mb-30">
                                                <div
                                                    class="course-reviews-info d-flex justify-content-between align-items-center">
                                                    <div class="reviews-author-info d-flex">
                                                        <div class="reviews-author-thumb">
                                                            <img src="img/testimonials/testimonilas_author_thumb1.png"
                                                                alt="">
                                                        </div>
                                                        <div class="reviews-author-title">
                                                            <h1>Nathaniel Bustos</h1>
                                                            <span>Manager</span>
                                                        </div>
                                                    </div>
                                                    <div class="courses-reviews-author-rating">
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
                                            <div class="cours-reviews-list mb-10">
                                                <div
                                                    class="course-reviews-info d-flex justify-content-between align-items-center">
                                                    <div class="reviews-author-info d-flex">
                                                        <div class="reviews-author-thumb">
                                                            <img src="img/testimonials/testimonilas_author_thumb2.png"
                                                                alt="">
                                                        </div>
                                                        <div class="reviews-author-title">
                                                            <h1>Latanya Kinard</h1>
                                                            <span>Web Designer</span>
                                                        </div>
                                                    </div>
                                                    <div class="courses-reviews-author-rating">
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
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="courses-details-sidebar-area">
                        <div class="widget mb-40 white-bg">
                            <div class="sidebar-form">
                                <form action="#">
                                    <input placeholder="Search course" type="text">
                                    <button type="submit">
                                        <i class="ti-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="widget mb-40 widget-padding white-bg">
                            <h4 class="widget-title">Category</h4>
                            <div class="widget-link">
                                <ul class="sidebar-link">
                                    @foreach($categories as $cat)
                                        <li><a href="#">{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget mb-40 widget-padding white-bg">
                            <h4 class="widget-title">Recent Course</h4>
                            <div class="sidebar-rc-post">
                                <ul>
                                    @foreach($recentCourses as $recent)
                                        <li>
                                            <div class="sidebar-rc-post-main-area d-flex mb-20">
                                                <div class="rc-post-thumb">
                                                    <a href="{{ route('course.details', ['slug' => $recent->slug]) }}">
                                                        <img src="{{ $recent->list_image ? asset($recent->list_image) : asset('frontend/img/courses/default.jpg') }}"
                                                            alt="{{ $recent->name }}">
                                                    </a>
                                                </div>
                                                <div class="rc-post-content">
                                                    <h4><a
                                                            href="{{ route('course.details', ['slug' => $recent->slug]) }}">{{ $recent->name }}</a>
                                                    </h4>
                                                    <div class="widget-advisors-name">
                                                        <span>Advisor : <span class="f-500">{{ $recent->advisor }}</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget mb-40 widget-padding white-bg">
                            <h4 class="widget-title">Recent Course</h4>
                            <div class="widget-tags clearfix">
                                <ul class="sidebar-tad clearfix">
                                    <li>
                                        <a href="#">CSE</a>
                                    </li>
                                    <li>
                                        <a href="#">Business</a>
                                    </li>
                                    <li>
                                        <a href="#">Study</a>
                                    </li>
                                    <li>
                                        <a href="#">English</a>
                                    </li>
                                    <li>
                                        <a href="#">Education</a>
                                    </li>
                                    <li>
                                        <a href="#">Engineering</a>
                                    </li>
                                    <li>
                                        <a href="#">Advisor</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- courses start -->
    <div class="courses-area courses-bg-height gray-bg pt-60 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="primary-color">Our Latest Courses</h1>
                        </div>
                        <div class="section-title-para">
                            <p>Belis nisl adipiscing sapien sed malesu diame lacus eget erat Cras mollis scelerisqu Nullam
                                arcu liquam here was consequat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="courses-list">
                <div class="row">
                    @foreach($recentCourses->where('id', '!=', $course->id) as $latest)
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="courses-wrapper courses-wrapper-3 mb-30">
                                <div class="courses-thumb">
                                    <a href="{{ route('course.details', ['slug' => $latest->slug]) }}">
                                        <img src="{{ $latest->list_image ? asset($latest->list_image) : asset('frontend/img/courses/default.jpg') }}"
                                            alt="{{ $latest->name }}">
                                    </a>
                                </div>
                                <div class="courses-content courses-content-3 clearfix">
                                    <div class="courses-heading mt-25 d-flex">
                                        <div class="course-title-3">
                                            <h1><a
                                                    href="{{ route('course.details', ['slug' => $latest->slug]) }}">{{ $latest->name }}</a>
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="courses-para mt-15">
                                        <p>{{ $latest->overview ? Str::limit(strip_tags($latest->overview), 80) : '' }}</p>
                                    </div>
                                    <div class="courses-wrapper-bottom clearfix mt-35">
                                        <div class="courses-button">
                                            <a href="{{ route('course.details', ['slug' => $latest->slug]) }}">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="courses-view-more-area mt-20 mb-30 text-center">
                    @if($recentCourses->where('id', '!=', $course->id)->count() > 0)
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="courses-view-more-btn">
                                    <button class="btn gray-border-btn">view more</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- courses end -->
    <!-- brand start -->
    <div class="brand-area pt-80 pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="brand-list">
                        <ul>
                            <li><img src="img/brand/brand1.png" alt=""></li>
                            <li><img src="img/brand/brand2.png" alt=""></li>
                            <li><img src="img/brand/brand3.png" alt=""></li>
                            <li><img src="img/brand/brand4.png" alt=""></li>
                            <li><img src="img/brand/brand5.png" alt=""></li>
                            <li><img src="img/brand/brand6.png" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand end -->

   

@endsection

@section('scripts')

@endsection