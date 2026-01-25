@extends('frontend.layouts.app')

@section('title', 'Our Team - Training Center')

@section('content')

    <!-- Our Team -->
 <section class="team-header">
        <div class="container">
            <h1>Meet Our Team</h1>
            <p>Dedicated professionals working together to deliver excellence and innovation in everything we do</p>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="team-grid">
                @forelse($teams as $member)
                <!-- Team Member -->
                <div class="team-member">
                    <div class="accent-bar"></div>
                    <div class="profile-img-wrapper">
                        @if($member->image)
                        <img src="/{{ $member->image }}" alt="{{ $member->name }}" class="profile-img">
                        @else
                        <img src="https://via.placeholder.com/400x400?text={{ urlencode($member->name) }}" alt="{{ $member->name }}" class="profile-img">
                        @endif
                    </div>
                    <h3 class="member-name">{{ $member->name }}</h3>
                    @if($member->designation)
                    <p class="member-position">{{ $member->designation }}</p>
                    @endif
                    @if($member->details)
                    <p class="member-description">{!! Str::limit(strip_tags($member->details), 100) !!}</p>
                    @endif
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No team members available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>


@endsection
