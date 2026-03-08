@extends('frontend.layouts.app')

@section('title', 'Members List - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Our Members</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Meet our valued organization members</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Members List Content -->
    <section class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 style="color: #1e40af;">Members Directory</h2>
                    <a href="{{ route('membership.form') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Become a Member
                    </a>
                </div>
                <p class="text-muted">Total Members: <strong>{{ $memberships->total() }}</strong></p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($memberships as $member)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="bg-white rounded-3 shadow-sm text-center p-4" style="transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">
                        <div class="mb-3">
                            @if($member->profile_picture)
                                <img src="{{ asset($member->profile_picture) }}" alt="{{ $member->full_name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #3b82f6;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 2.5rem; margin: 0 auto;">
                                    {{ substr($member->full_name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-2" style="color: #1e40af; font-weight: 600;">{{ $member->full_name }}</h5>

                        <div class="mb-2">
                            <span class="badge" style="background: #3b82f6; color: white;">{{ $member->membership_type }}</span>
                        </div>

                        <div class="details-section" style="text-align: left; margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                            {{-- @if($member->nid_passport_no)
                                <p class="small mb-2"><i class="fas fa-id-card text-primary"></i> <strong>{{ $member->nid_passport_no }}</strong></p>
                            @endif --}}
                            @if($member->organization)
                                <p class="small mb-2"><i class="fas fa-building text-primary"></i> <strong>{{ $member->organization }}</strong></p>
                            @endif
                            @if($member->occupation)
                                <p class="small mb-2"><i class="fas fa-briefcase text-primary"></i> {{ $member->occupation }}</p>
                            @endif
                            @if($member->course_name)
                                <p class="small mb-2"><i class="fas fa-graduation-cap text-primary"></i> {{ $member->course_name }}</p>
                            @endif
                            @if($member->mobile)
                                <p class="small mb-1"><i class="fas fa-phone text-primary"></i> {{ $member->mobile }}</p>
                            @endif
                            @if($member->email)
                                <p class="small mb-0"><i class="fas fa-envelope text-primary"></i> {{ $member->email }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fas fa-info-circle"></i> No members found at the moment.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($memberships->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $memberships->links() }}
                </div>
            </div>
        @endif
    </section>
@endsection
