@extends('frontend.member.layouts.dashboard')

@section('title', 'Update Profile')
@section('page-title', 'Update Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom">
            <div class="card-header">
                <i class="fas fa-user-edit me-2"></i>Edit Your Profile
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Profile Picture -->
                    <div class="text-center mb-4">
                        @if($member->profile_picture)
                            <img src="{{ url($member->profile_picture) }}" id="profilePreview" alt="{{ $member->full_name }}" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->full_name) }}&background=667eea&color=fff&size=100" id="profilePreview" class="rounded-circle mb-2" alt="{{ $member->full_name }}">
                        @endif
                        <div>
                            <label for="profile_picture" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="fas fa-camera me-1"></i>Change Photo
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/*">
                        </div>
                        @error('profile_picture')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror"
                                   value="{{ old('full_name', $member->full_name) }}" required>
                            @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror"
                                   value="{{ old('mobile', $member->mobile) }}" required>
                            @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $member->email }}" disabled>
                            <small class="text-muted">Email cannot be changed. Contact admin if needed.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Membership Type</label>
                            <input type="text" class="form-control" value="{{ $member->membership_type }}" disabled>
                        </div>

                        <div class="col-12">
                            <label for="present_address" class="form-label">Present Address</label>
                            <textarea name="present_address" id="present_address" rows="2" class="form-control @error('present_address') is-invalid @enderror">{{ old('present_address', $member->present_address) }}</textarea>
                            @error('present_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="permanent_address" class="form-label">Permanent Address</label>
                            <textarea name="permanent_address" id="permanent_address" rows="2" class="form-control @error('permanent_address') is-invalid @enderror">{{ old('permanent_address', $member->permanent_address) }}</textarea>
                            @error('permanent_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror"
                                   value="{{ old('occupation', $member->occupation) }}">
                            @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" name="organization" id="organization" class="form-control @error('organization') is-invalid @enderror"
                                   value="{{ old('organization', $member->organization) }}">
                            @error('organization')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="office_address" class="form-label">Office Address</label>
                            <input type="text" name="office_address" id="office_address" class="form-control @error('office_address') is-invalid @enderror"
                                   value="{{ old('office_address', $member->office_address) }}">
                            @error('office_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.getElementById('profile_picture').addEventListener('change', function(e) {
    if (e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profilePreview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endsection
@endsection
