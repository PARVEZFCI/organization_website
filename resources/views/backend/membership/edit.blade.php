@extends('backend.admin-layout')
@section('title', 'Edit Member - Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-10 offset-md-1">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-edit"></i>
                        Edit Member Details
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('Admin.membership.update', $membership->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ $membership->full_name }}" required>
                                        @error('full_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ $membership->mobile }}" required>
                                        @error('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $membership->email }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nid_passport_no" class="form-label">NID/Passport No</label>
                                        <input type="text" class="form-control @error('nid_passport_no') is-invalid @enderror" id="nid_passport_no" name="nid_passport_no" value="{{ $membership->nid_passport_no }}">
                                        @error('nid_passport_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ $membership->dob }}">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ $membership->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $membership->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ $membership->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="blood_group" class="form-label">Blood Group</label>
                                        <input type="text" class="form-control @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group" value="{{ $membership->blood_group }}">
                                        @error('blood_group')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="present_address" class="form-label">Present Address</label>
                                        <textarea class="form-control @error('present_address') is-invalid @enderror" id="present_address" name="present_address" rows="2">{{ $membership->present_address }}</textarea>
                                        @error('present_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="permanent_address" class="form-label">Permanent Address</label>
                                        <textarea class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address" name="permanent_address" rows="2">{{ $membership->permanent_address }}</textarea>
                                        @error('permanent_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="course_name" class="form-label">Course Name</label>
                                        <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name" value="{{ $membership->course_name }}">
                                        @error('course_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="intake_no" class="form-label">Intake No</label>
                                        <input type="text" class="form-control @error('intake_no') is-invalid @enderror" id="intake_no" name="intake_no" value="{{ $membership->intake_no }}">
                                        @error('intake_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="passing_year" class="form-label">Passing Year</label>
                                        <input type="number" class="form-control @error('passing_year') is-invalid @enderror" id="passing_year" name="passing_year" value="{{ $membership->passing_year }}">
                                        @error('passing_year')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ $membership->occupation }}">
                                        @error('occupation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="organization" class="form-label">Organization</label>
                                        <input type="text" class="form-control @error('organization') is-invalid @enderror" id="organization" name="organization" value="{{ $membership->organization }}">
                                        @error('organization')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="office_address" class="form-label">Office Address</label>
                                        <textarea class="form-control @error('office_address') is-invalid @enderror" id="office_address" name="office_address" rows="2">{{ $membership->office_address }}</textarea>
                                        @error('office_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="membership_type" class="form-label">Membership Type <span class="text-danger">*</span></label>
                                        <select class="form-control @error('membership_type') is-invalid @enderror" id="membership_type" name="membership_type" required>
                                            <option value="">Select Type</option>
                                            <option value="General" {{ $membership->membership_type == 'General' ? 'selected' : '' }}>General</option>
                                            <option value="Life" {{ $membership->membership_type == 'Life' ? 'selected' : '' }}>Life</option>
                                            <option value="Associate" {{ $membership->membership_type == 'Associate' ? 'selected' : '' }}>Associate</option>
                                        </select>
                                        @error('membership_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="payment_type" class="form-label">Payment Type <span class="text-danger">*</span></label>
                                        <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" required>
                                            <option value="">Select Type</option>
                                            <option value="membership_fee" {{ $membership->payment_type == 'membership_fee' ? 'selected' : '' }}>Membership Fee</option>
                                            <option value="monthly_gm" {{ $membership->payment_type == 'monthly_gm' ? 'selected' : '' }}>Monthly GM</option>
                                            <option value="monthly_ec" {{ $membership->payment_type == 'monthly_ec' ? 'selected' : '' }}>Monthly EC</option>
                                            <option value="lifetime" {{ $membership->payment_type == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                            <option value="event_fee" {{ $membership->payment_type == 'event_fee' ? 'selected' : '' }}>Event Fee</option>
                                            <option value="donation" {{ $membership->payment_type == 'donation' ? 'selected' : '' }}>Donation</option>
                                        </select>
                                        @error('payment_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $membership->amount }}" required>
                                        @error('amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" value="{{ $membership->payment_method }}" required>
                                        @error('payment_method')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="active" {{ $membership->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $membership->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="profile_picture" class="form-label">Profile Picture</label>
                                        @if($membership->profile_picture)
                                            <div class="mb-2">
                                                <img src="{{ asset($membership->profile_picture) }}" alt="{{ $membership->full_name }}" style="max-height: 150px; max-width: 150px; border-radius: 8px; object-fit: cover;">
                                                <p class="small text-muted mt-1">Current Image</p>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" accept="image/*">
                                        <small class="form-text text-muted">Leave empty to keep current image</small>
                                        @error('profile_picture')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update Member
                                </button>
                                <a href="{{ route('Admin.membership.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
