@extends('frontend.layouts.app')

@section('title', 'Courses - Training Center')

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
                                <h1 class="white-color f-700">Our Course</h1>
                                <nav class="text-center" aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Our Course</li>
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
    <!-- courses start -->
    <div class="courses-area courses-bg-height gray-bg pt-100 pb-70">
        <div class="container">
            <div class="courses-list">
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="courses-wrapper course-radius-none mb-30">
                                <div class="courses-thumb">
                                    <a href="#"><img src="/{{ $course->list_image ?? 'frontend/img/courses/default.jpg' }}"
                                            alt="{{ $course->name }}" class="img-fluid"></a>
                                </div>
                                <!-- <div class="courses-author">
                                    @if($course->banner_image)
                                        <img src="/{{ $course->banner_image }}" alt="Banner" class="img-fluid">
                                    @endif
                                </div> -->
                                <div class="course-main-content clearfix">
                                    <div class="courses-content">
                                        <div class="courses-category-name">
                                            <span>
                                                <a
                                                    href="#">{{ $course->category ? $course->category->name : 'Uncategorized' }}</a>
                                            </span>
                                        </div>
                                        <div class="courses-heading">
                                            <h1><a href="#">{{ $course->name }}</a></h1>
                                        </div>
                                        <div class="courses-para">
                                            <p>{!! Str::limit($course->overview, 120) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="courses-wrapper-bottom clearfix">
                                    <div class="courses-icon d-flex f-left">
                                        <div class="courses-single-icon">
                                            <span><i class="fa fa-user"></i></span>
                                            <span>{{ $course->student }}</span>
                                        </div>
                                        <div class="courses-single-icon">
                                            <span><i class="fa fa-chalkboard-teacher"></i></span>
                                            <span>{{ $course->lecture }}</span>
                                        </div>
                                        <div class="courses-single-icon">
                                            <span><i class="fa fa-clock"></i></span>
                                            <span>{{ $course->time }}</span>
                                        </div>
                                    </div>
                                    <div class="courses-button f-right">
                                        <a href="{{ route('course.details',$course->slug) }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-courses-btn text-center mt-15 mb-30">
                            <button class="btn black-border">View all course</button>
                        </div>
                    </div>
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
