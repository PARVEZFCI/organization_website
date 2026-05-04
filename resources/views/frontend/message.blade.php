@extends('frontend.layouts.app')

@section('title', 'Message from Leadership - BESWA')

@section('content')
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%);min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Message from Leadership</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Words from the leaders of BESWA</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.about-submenu')

    <section class="container my-5">
        <div class="row g-4">
            @forelse($leadershipMessages as $leadershipMessage)
                <div class="col-lg-6">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                @if($leadershipMessage->image)
                                    <img src="{{ asset($leadershipMessage->image) }}" alt="{{ $leadershipMessage->name }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 3rem;">
                                        {{ strtoupper(substr($leadershipMessage->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h4 class="mb-1" style="color: #1e40af;">{{ $leadershipMessage->name }}</h4>
                            <p class="text-muted mb-0">{{ $leadershipMessage->designation }}</p>
                        </div>
                        <div style="line-height: 1.8; color: #334155;">
                            {!! nl2br(e($leadershipMessage->message)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No leadership messages are available right now.
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
