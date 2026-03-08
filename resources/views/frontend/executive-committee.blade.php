@extends('frontend.layouts.app')

@section('title', 'Executive Committee - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Executive Committee</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Meet our leadership team</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Executive Committee Content -->
    <section class="container my-5">
        <div class="row g-4">
            @forelse($committees as $member)
                <div class="col-lg-3 col-md-6">
                    <div class="bg-white rounded-3 shadow-sm text-center p-4" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">
                        <div class="mb-3">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 3rem; margin: 0 auto;">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-1" style="color: #1e40af;">{{ $member->name }}</h5>
                        <p class="text-primary mb-2"><strong>{{ $member->position }}</strong></p>
                        @if($member->description)
                            <p class="small text-muted mb-2">{{ $member->description }}</p>
                        @endif
                        @if($member->email || $member->phone)
                            <div class="mt-3 pt-2 border-top">
                                @if($member->email)
                                    <p class="small mb-1"><i class="fas fa-envelope"></i> {{ $member->email }}</p>
                                @endif
                                @if($member->phone)
                                    <p class="small mb-0"><i class="fas fa-phone"></i> {{ $member->phone }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        No committee members found. Please add members from the admin panel.
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
