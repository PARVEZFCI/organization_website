<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html>
<head>
    <title>BESWA Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @php $settings = DB::table('settings')->orderBy('id','DESC')->first(); @endphp
    <style>
        :root{ --brand:#0b3d91; --accent:#f9c851; --muted:#56626c; }
        body{ background: linear-gradient(180deg,#f6f9fc 0%, #fff 100%); font-family: 'Nunito', sans-serif; }
        .login-wrap{ min-height:100vh; display:flex; align-items:center; justify-content:center; padding:40px 15px; }
        .login-card{ width:100%; max-width:920px; background:#fff; border-radius:12px; box-shadow:0 10px 30px rgba(15,30,60,0.08); display:flex; overflow:hidden; }
        .login-left{ flex:1.1; background: linear-gradient(180deg, rgba(11,61,145,0.95), rgba(11,61,145,0.85)); color:#fff; padding:48px; display:flex; flex-direction:column; align-items:flex-start; justify-content:center; }
        .login-left .logo{ width:88px; height:88px; border-radius:12px; background:#fff; padding:8px; display:flex; align-items:center; justify-content:center; margin-bottom:20px; }
        .login-left h2{ margin:0 0 12px; font-size:22px; color:#fff; }
        .login-left p{ color:rgba(255,255,255,0.95); line-height:1.6; max-width:320px; }
        .login-left .socials{ margin-top:20px; }
        .login-left .socials a{ color:rgba(255,255,255,0.9); margin-right:10px; font-size:18px; }

        .login-right{ flex:0.9; padding:36px 44px; }
        .login-right h3{ margin-bottom:18px; }
        .form-control{ border-radius:8px; padding:12px 14px; border:1px solid #e6eef6; }
        .btn-beswa{ background:var(--brand); color:#fff; padding:10px 14px; border-radius:8px; width:100%; border:0; }
        .text-muted-small{ color:var(--muted); font-size:14px; }
        .footer-note{ margin-top:18px; font-size:13px; color:#98a4b1; }
        @media (max-width:768px){
            .login-card{ flex-direction:column; }
            /* hide left panel on small screens for a cleaner mobile login */
            .login-left{ display:none !important; }
            .login-right{ flex:1 !important; padding:20px; }
        }
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="login-card">
        <div class="login-left">
            <div class="logo">
                @if(isset($settings) && $settings->logo)
                    <img src="{{ url($settings->logo) }}" alt="Logo" style="max-width:100%; max-height:100%; object-fit:contain;">
                @else
                    <img src="{{ asset('frontend/img/default-logo.png') }}" alt="Logo" style="max-width:100%; max-height:100%; object-fit:contain;">
                @endif
            </div>
            <h2>{{ $settings->company_name ?? 'BESWA' }}</h2>
            <p>BESWA is a voluntary, non-profit alumni organization supporting BIMT students and graduates through welfare, education, professional growth, and social development initiatives.</p>
            <div class="socials mt-3">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="ml-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="ml-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="ml-2"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="login-right">
            <h3>Sign in to Admin</h3>

            @if(session('message'))
                <div class="alert alert-{{ session('class') ?? 'info' }}">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ url('/admin_login_action') }}">
                @csrf
                <div class="form-group">
                    <label class="text-muted-small">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@example.com" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label class="text-muted-small">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Your password">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label text-muted-small" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="text-muted-small">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-beswa">Sign In</button>
            </form>

            <div class="footer-note">Powered by BESWA • Admin Panel</div>
        </div>
    </div>
</div>

