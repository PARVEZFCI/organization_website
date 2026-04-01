@extends('frontend.member.layouts.dashboard')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card-custom">
            <div class="card-header">
                <i class="fas fa-key me-2"></i>Change Your Password
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('member.change-password.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Enter current password" required>
                        </div>
                        @error('current_password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter new password (min 6 chars)" required>
                        </div>
                        @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm new password" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shield-alt me-2"></i>Update Password
                        </button>
                    </div>
                </form>

                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="mb-2"><i class="fas fa-info-circle text-primary me-2"></i>Password Requirements</h6>
                    <ul class="small text-muted mb-0">
                        <li>Minimum 6 characters</li>
                        <li>New password must match confirmation</li>
                        <li>Use a combination of letters and numbers for better security</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
