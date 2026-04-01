@extends('frontend.layouts.app')

@section('title', 'Member Login')

@section('content')
<style>
.member-login-wrapper {
    padding: 60px 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
}
.login-card {
    max-width: 480px;
    margin: 0 auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    overflow: hidden;
}
.login-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 35px 30px;
    text-align: center;
}
.login-header h2 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 5px;
}
.login-header p {
    opacity: 0.9;
    margin: 0;
    font-size: 14px;
}
.login-header .login-icon {
    width: 65px;
    height: 65px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 28px;
}
.login-body {
    padding: 35px 30px;
}
.login-body .form-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 14px;
}
.login-body .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
}
.login-body .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
}
.login-body .input-group-text {
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    border-right: none;
    border-radius: 8px 0 0 8px;
    color: #a0aec0;
}
.login-body .input-group .form-control {
    border-left: none;
    border-radius: 0 8px 8px 0;
}
.btn-member-login {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    color: #fff;
    width: 100%;
    transition: all 0.3s;
}
.btn-member-login:hover {
    opacity: 0.9;
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    color: #fff;
}
.login-footer {
    text-align: center;
    padding: 0 30px 25px;
}
.login-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}
.login-footer a:hover {
    text-decoration: underline;
}
</style>

<div class="member-login-wrapper">
    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2>Member Login</h2>
                <p>Access your membership dashboard</p>
            </div>

            <div class="login-body">
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

                <form method="POST" action="{{ route('member.login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter your password" required>
                        </div>
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-member-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>
            </div>

            <div class="login-footer">
                <p class="text-muted small mb-1">Not a member yet?</p>
                <a href="{{ route('membership.form') }}">Apply for Membership</a>
            </div>
        </div>
    </div>
</div>
@endsection
