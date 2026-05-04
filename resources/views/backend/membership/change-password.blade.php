@extends('backend.admin-layout')
@section('title', 'Change Member Password - Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-8 offset-md-2">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-warning">
                        <i class="fa fa-key"></i>
                        Change Member Password
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="alert alert-info">
                            <strong>Member:</strong> {{ $membership->full_name }}<br>
                            <strong>Email:</strong> {{ $membership->email }}<br>
                            <strong>Mobile:</strong> {{ $membership->mobile }}
                        </div>

                        <form action="{{ route('Admin.membership.password.update', $membership->id) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                <small class="form-text text-muted">Use at least 8 characters for the new password.</small>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-save"></i> Update Password
                            </button>
                            <a href="{{ route('Admin.membership.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back to Member List
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
