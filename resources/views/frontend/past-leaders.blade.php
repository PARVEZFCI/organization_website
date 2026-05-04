@extends('frontend.layouts.app')

@section('title', 'Past Leaders - BESWA')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #619af8 0%, #3b82f6 100%); min-height: 40vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="mb-3" style="color: white; font-size: clamp(1.8rem, 5vw, 2.5rem); font-weight: 700;">Past Leaders</h1>
                    <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: clamp(1rem, 3vw, 1.2rem);">Honoring the committees who helped shape BESWA</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Period List Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            @forelse($periods as $period)
                <div class="mb-4">
                    <a href="{{ route('past-leaders.period', $period->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease; border-left: 4px solid #3b82f6 !important;"
                             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 30px rgba(59, 130, 246, 0.2)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <i class="fas fa-users" style="font-size: 1.5rem; color: white;"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h4 class="mb-2" style="color: #1e40af; font-weight: 600; font-size: clamp(1.2rem, 3vw, 1.5rem);">
                                                    {{ $period->title }}
                                                </h4>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    @if($period->start_year || $period->end_year)
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="font-size: 0.9rem; font-weight: 500;">
                                                            <i class="far fa-calendar-alt me-1"></i>
                                                            {{ $period->start_year ?? '...' }} - {{ $period->end_year ?? '...' }}
                                                        </span>
                                                    @endif
                                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2" style="font-size: 0.9rem; font-weight: 500;">
                                                        <i class="fas fa-user-friends me-1"></i>
                                                        {{ $period->members_count ?? $period->members->count() }} Members
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-5 text-md-end">
                                        <span class="btn btn-primary px-4 py-2" style="font-weight: 500;">
                                            View Members
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-users-slash" style="font-size: 4rem; color: #cbd5e1;"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Past Leaders Found</h4>
                    <p class="text-muted">Please check back later for past committee information.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
