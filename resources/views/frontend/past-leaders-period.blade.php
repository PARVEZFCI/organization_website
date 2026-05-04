@extends('frontend.layouts.app')

@section('title', $period->title . ' - Past Leaders - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="    background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%); min-height: 45vh; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.3;"></div>

        <div class="container position-relative">
            <!-- Back Button -->
            {{-- <div class="mb-4">
                <a href="{{ route('past-leaders') }}" class="btn btn-light btn-sm px-4 py-2" style="border-radius: 50px; font-weight: 500;">
                    <i class="fas fa-arrow-left me-2"></i> Back to All Periods
                </a>
            </div> --}}

            <!-- Period Title -->
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="mb-4">
                        <span class="badge bg-white bg-opacity-25 text-white px-4 py-2 mb-3" style="font-size: 1rem; font-weight: 500; border-radius: 50px;">
                            <i class="far fa-calendar-alt me-2"></i>
                            @if($period->start_year || $period->end_year)
                                {{ $period->start_year ?? '...' }} - {{ $period->end_year ?? '...' }}
                            @else
                                Past Committee Period
                            @endif
                        </span>
                    </div>
                    <h1 class="mb-3" style="color: white; font-size: clamp(2rem, 5vw, 3rem); font-weight: 700;">
                        {{ $period->title }}
                    </h1>
                    <p class="mb-4" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.25rem);">
                        Meet the dedicated team members who served during this period
                    </p>
                    <div class="d-flex justify-content-center gap-4 flex-wrap">
                        <div class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-users" style="font-size: 1.5rem; color: white;"></i>
                                <span style="font-size: 2rem; font-weight: 700; color: white;">{{ $period->members->count() }}</span>
                            </div>
                            <p class="mb-0 mt-1" style="color: rgba(255,255,255,0.9); font-size: 0.9rem;">Total Members</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Members Section -->
    <section class="py-5" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            @if($period->members->count() > 0)
                <div class="row g-4">
                    @foreach($period->members as $member)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card border-0 shadow-sm h-100 text-center"
                                 style="transition: all 0.3s ease; border-radius: 15px; overflow: hidden;"
                                 onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">

                                <!-- Image Section -->
                                <div class="p-4 pb-3">
                                    <div class="position-relative d-inline-block">
                                        @if($member->image)
                                            <img src="{{ asset('storage/' . $member->image) }}"
                                                 alt="{{ $member->name }}"
                                                 class="rounded-circle"
                                                 style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 140px; height: 140px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 3rem; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <!-- Serial Badge -->
                                        @if($member->serial)
                                            <span class="badge bg-primary position-absolute"
                                                  style="top: 0; right: 0; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);">
                                                {{ $member->serial }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="card-body pt-0 px-4 pb-4">
                                    <h5 class="mb-2" style="color: #1e40af; font-weight: 600; font-size: 1.1rem;">
                                        {{ $member->name }}
                                    </h5>
                                    <p class="mb-0 text-muted" style="font-size: 0.95rem; font-weight: 500;">
                                        {{ $member->designation }}
                                    </p>
                                </div>

                                <!-- Decorative Bottom Border -->
                                <div style="height: 4px; background: linear-gradient(to right, #667eea 0%, #764ba2 100%);"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-slash" style="font-size: 5rem; color: #cbd5e1;"></i>
                    </div>
                    <h4 class="text-muted mb-3">No Members Found</h4>
                    <p class="text-muted mb-4">There are no members assigned to this committee period yet.</p>
                    <a href="{{ route('past-leaders') }}" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-arrow-left me-2"></i> Back to All Periods
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Additional Info Section (Optional) -->
    @if($period->members->count() > 0)
        <section class="py-4" style="background-color: #f8f9fa;">
            <div class="container">
                <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-4 text-center text-white">
                        <p class="mb-0" style="font-size: 1.1rem; font-weight: 500;">
                            <i class="fas fa-heart me-2"></i>
                            Thank you to all the dedicated members who served during {{ $period->title }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
