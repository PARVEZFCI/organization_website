<section class="py-4" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('about') }}" class="btn {{ request()->routeIs('about') ? 'btn-primary' : 'btn-outline-primary' }}">About Us</a>
            <a href="{{ route('about.mission-vision') }}" class="btn {{ request()->routeIs('about.mission-vision') ? 'btn-primary' : 'btn-outline-primary' }}">Mission & Vision</a>
            <a href="{{ route('about.aims-objectives') }}" class="btn {{ request()->routeIs('about.aims-objectives') ? 'btn-primary' : 'btn-outline-primary' }}">Aims & Objectives</a>
            <a href="{{ route('message') }}" class="btn {{ request()->routeIs('message') ? 'btn-primary' : 'btn-outline-primary' }}">Leadership Message</a>
        </div>
    </div>
</section>
