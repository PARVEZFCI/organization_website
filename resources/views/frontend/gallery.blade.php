@extends('frontend.layouts.app')

@section('title', 'Photo Gallery - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ffffff 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Photo Gallery</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Glimpses of our work and activities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Content -->
    <section class="container my-5">
        <div class="row g-4">
            @forelse($photoGalleries ?? [] as $photo)
            <div class="col-lg-3 col-md-6">
                <div class="gallery-item">
                    @if($photo->image ?? false)
                        <img src="/{{ $photo->image }}" alt="Gallery" class="gallery-img">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image" class="gallery-img">
                    @endif
                    <div class="gallery-overlay">
                        <div class="gallery-badge">
                            <i class="fas fa-image"></i>
                            <span>Gallery</span>
                        </div>
                        <div class="gallery-zoom" aria-hidden="true">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No photos available in the gallery.</p>
            </div>
            @endforelse
        </div>
    </section>
@endsection
