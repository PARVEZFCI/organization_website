@extends('frontend.layouts.app')

@section('title', 'Bylaws - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Bylaws</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Our organizational bylaws and regulations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bylaws Content -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white rounded-3 shadow-sm p-4 p-md-5">
                    @if($bylaw && $bylaw->content)
                        <div class="bylaws-content" style="line-height: 1.8; color: #374151;">
                            {!! $bylaw->content !!}
                        </div>
                    @else
                        <p class="text-muted text-center py-5">Bylaws content has not been added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
