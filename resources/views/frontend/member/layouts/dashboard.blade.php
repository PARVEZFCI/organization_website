<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member Dashboard')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    @if(isset($settings) && $settings->favicon)
    <link rel="icon" href="{{ url($settings->favicon) }}">
    @else
    <link rel="icon" href="{{ url('Fav Icon.png') }}">
    @endif
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --sidebar-width: 260px;
        }
        body { background: #f0f2f5; }

        .member-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            z-index: 1040;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        .member-sidebar .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .member-sidebar .sidebar-header img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.3);
            margin-bottom: 10px;
        }
        .member-sidebar .sidebar-header h6 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
        }
        .member-sidebar .sidebar-header small {
            opacity: 0.8;
            font-size: 12px;
        }
        .sidebar-nav {
            padding: 15px 0;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(255,255,255,0.12);
            color: #fff;
            border-left-color: #fff;
        }
        .sidebar-nav a i {
            width: 22px;
            margin-right: 12px;
            font-size: 16px;
            text-align: center;
        }
        .sidebar-nav .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.12);
            margin: 10px 20px;
        }

        .member-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .member-topbar {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        .member-topbar .page-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }
        .member-main {
            padding: 25px 30px;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: #2d3748;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1035;
        }

        @media (max-width: 991px) {
            .member-sidebar {
                transform: translateX(-100%);
            }
            .member-sidebar.show {
                transform: translateX(0);
            }
            .member-content {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }
        .stat-card .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: #2d3748;
        }
        .stat-card .stat-label {
            font-size: 13px;
            color: #718096;
            margin: 0;
        }

        .card-custom {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: none;
        }
        .card-custom .card-header {
            background: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 18px 24px;
            font-weight: 600;
            color: #2d3748;
        }
        .card-custom .card-body {
            padding: 24px;
        }

        .back-to-site {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
            border-top: 1px solid rgba(255,255,255,0.12);
            margin-top: auto;
        }
        .back-to-site:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }
        .back-to-site i { margin-right: 10px; }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    @php $member = Auth::guard('member')->user(); @endphp
    <aside class="member-sidebar" id="memberSidebar">
        <div class="sidebar-header">
            @if($member->profile_picture)
                <img src="{{ url($member->profile_picture) }}" alt="{{ $member->full_name }}">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($member->full_name) }}&background=667eea&color=fff&size=70" alt="{{ $member->full_name }}">
            @endif
            <h6>{{ $member->full_name }}</h6>
            <small>{{ $member->membership_type }} Member</small>
        </div>

        <nav class="sidebar-nav d-flex flex-column" style="height: calc(100vh - 160px);">
            <div>
                <a href="{{ route('member.dashboard') }}" class="{{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('member.payments') }}" class="{{ request()->routeIs('member.payments') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave"></i> Payment History
                </a>

                <div class="nav-divider"></div>

                <a href="{{ route('member.profile') }}" class="{{ request()->routeIs('member.profile') ? 'active' : '' }}">
                    <i class="fas fa-user-edit"></i> Update Profile
                </a>
                <a href="{{ route('member.change-password') }}" class="{{ request()->routeIs('member.change-password') ? 'active' : '' }}">
                    <i class="fas fa-key"></i> Change Password
                </a>

                <div class="nav-divider"></div>

                <form action="{{ route('member.logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" style="background:none;border:none;width:100%;text-align:left;padding:12px 25px;color:rgba(255,255,255,0.85);font-size:14px;cursor:pointer;">
                        <i class="fas fa-sign-out-alt" style="width:22px;margin-right:12px;text-align:center;"></i> Logout
                    </button>
                </form>
            </div>

            <a href="{{ url('/') }}" class="back-to-site mt-auto">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="member-content">
        <div class="member-topbar">
            <div class="d-flex align-items-center">
                <button class="sidebar-toggle me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="page-title">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-success me-2">{{ $member->membership_type }}</span>
                <span class="text-muted small">{{ $member->email }}</span>
            </div>
        </div>

        <div class="member-main">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('memberSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
