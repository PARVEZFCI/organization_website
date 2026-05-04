@extends('frontend.layouts.app')

@section('title', 'Membership Application - BESWA')

@section('content')
<style>
.membership-wrapper {
    /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
    padding: 60px 0;
    margin-top: -20px;
}
.membership-form-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    overflow: hidden;
}
.membership-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
}
.membership-header h2 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
}
.membership-header p {
    font-size: 16px;
    opacity: 0.95;
    margin: 0;
}
.form-section {
    padding: 30px 40px;
}
.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}
.section-number {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 700;
    margin-right: 15px;
    flex-shrink: 0;
}
.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}
.section-subtitle {
    font-size: 13px;
    color: #718096;
    margin: 0;
}
.form-label {
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 8px;
    font-size: 14px;
}
.form-control, .form-select {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s;
}
.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}
.input-icon {
    color: #a0aec0;
    margin-right: 8px;
}
.form-actions {
    background: #f7fafc;
    padding: 25px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 40px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
}
.btn-cancel {
    color: #718096;
    padding: 14px 30px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}
.btn-cancel:hover {
    border-color: #cbd5e0;
    background: #f7fafc;
}
.membership-types {
    display: flex;
    gap: 15px;
}
.membership-card {
    flex: 1;
    padding: 20px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
}
.membership-card:hover {
    border-color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
}
.membership-card.selected {
    border-color: #667eea;
    background: #f0f4ff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
}
.membership-card input[type="radio"] {
    display: none;
}
.membership-card input[type="radio"]:checked + .card-content {
    color: #667eea;
}
.help-text {
    font-size: 12px;
    color: #a0aec0;
    margin-top: 5px;
}
.payment-option-card {
    padding: 15px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.payment-option-card:hover {
    border-color: #667eea;
    background: #f7fafc;
}
.payment-option-card input[type="radio"] {
    margin-right: 12px;
    width: 20px;
    height: 20px;
    cursor: pointer;
}
.payment-option-card input[type="radio"]:checked ~ .payment-info {
    color: #667eea;
}
.payment-option-card.selected {
    border-color: #667eea;
    background: #f0f4ff;
}
.payment-info {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 12px;
}
.payment-icon {
    font-size: 24px;
    color: #667eea;
}
.payment-details h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #2d3748;
}
.payment-details p {
    margin: 0;
    font-size: 12px;
    color: #718096;
}
.payment-amount {
    font-size: 18px;
    font-weight: 700;
    color: #667eea;
}
.total-amount-box {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    margin-top: 20px;
}
.total-amount-box h5 {
    margin: 0 0 10px 0;
    font-size: 16px;
    opacity: 0.9;
}
.total-amount-box .amount {
    font-size: 36px;
    font-weight: 700;
}
</style>

@php
    $fees = isset($fees) ? $fees : collect([
        'General' => ['fee' => 0, 'monthly_fee' => 100],
        'Life' => ['fee' => 0, 'monthly_fee' => 0],
        'Associate' => ['fee' => 0, 'monthly_fee' => 0],
        'Founder' => ['fee' => 0, 'monthly_fee' => 0],
    ]);
@endphp

<div class="membership-wrapper">
    <div class="membership-form-container">
        <div class="membership-header">
            <h2><i class="fas fa-users"></i> Membership Application</h2>
            <p>Join our community and make a difference together</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success m-4 rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif

        <form action="{{ route('membership.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Personal Information -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-number">1</div>
                    <div>
                        <div class="section-title"><i class="fas fa-user me-2"></i>Personal Information</div>
                        <div class="section-subtitle">Tell us about yourself</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-user input-icon"></i>Full Name <sup class="text-danger">*</sup></label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter your full name" required>
                        @error('full_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-id-card input-icon"></i>NID/Passport No</label>
                        <input type="text" name="nid_passport_no" value="{{ old('nid_passport_no') }}" class="form-control" placeholder="Enter NID or Passport number">
                        @error('nid_passport_no')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-calendar input-icon"></i>Date of Birth</label>
                        <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
                        @error('dob')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-venus-mars input-icon"></i>Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender')=='Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-tint input-icon"></i>Blood Group</label>
                        <select name="blood_group" class="form-select">
                            <option value="">Select Blood Group</option>
                            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group')==$bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                        @error('blood_group')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-map-marker-alt input-icon"></i>Present Address</label>
                        <textarea name="present_address" class="form-control" rows="2" placeholder="Current residential address">{{ old('present_address') }}</textarea>
                        @error('present_address')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label"><i class="fas fa-home input-icon"></i>Permanent Address</label>
                        <textarea name="permanent_address" class="form-control" rows="2" placeholder="Permanent residential address">{{ old('permanent_address') }}</textarea>
                        @error('permanent_address')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label"><i class="fas fa-camera input-icon"></i>Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control" accept="image/*">
                        <small class="help-text">Upload a recent photo (Max 2MB, JPG/PNG)</small>
                        @error('profile_picture')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Academic Records -->
            <div class="form-section" style="background: #fafbfc;">
                <div class="section-header">
                    <div class="section-number">2</div>
                    <div>
                        <div class="section-title"><i class="fas fa-graduation-cap me-2"></i>Academic Records</div>
                        <div class="section-subtitle">Your educational background</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-book input-icon"></i>Course Name</label>
                        <input type="text" name="course_name" class="form-control" value="{{ old('course_name') }}" placeholder="e.g. Diploma in Computer Science">
                        @error('course_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-hashtag input-icon"></i>Intake No.</label>
                        <input type="text" name="intake_no" class="form-control" value="{{ old('intake_no') }}" placeholder="e.g. 45">
                        @error('intake_no')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-calendar-check input-icon"></i>Passing Year</label>
                        <input type="number" name="passing_year" class="form-control" value="{{ old('passing_year') }}" placeholder="e.g. 2020">
                        @error('passing_year')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <!-- Section 3: Professional & Contact Details -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-number">3</div>
                    <div>
                        <div class="section-title"><i class="fas fa-briefcase me-2"></i>Professional & Contact Details</div>
                        <div class="section-subtitle">How can we reach you?</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="fab fa-whatsapp input-icon"></i>Mobile Number <sup class="text-danger">*</sup></label>
                        <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="+880 1XXX-XXXXXX" required>
                        <small class="help-text">Preferably with WhatsApp</small>
                        @error('mobile')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-envelope input-icon"></i>Email Address <sup class="text-danger">*</sup></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your.email@example.com" required>
                        @error('email')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-user-tie input-icon"></i>Current Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}" placeholder="e.g. Software Engineer">
                        @error('occupation')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-lock input-icon"></i>Password <sup class="text-danger">*</sup></label>
                        <input type="password" name="password" class="form-control" placeholder="Create a secure password" required>
                        <small class="help-text">You will use this password to access the member portal after approval.</small>
                        @error('password')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-lock input-icon"></i>Confirm Password <sup class="text-danger">*</sup></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter your password" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-building input-icon"></i>Organization / Company Name</label>
                        <input type="text" name="organization" class="form-control" value="{{ old('organization') }}" placeholder="Company you work for">
                        @error('organization')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-map-marked-alt input-icon"></i>Office Address</label>
                        <input type="text" name="office_address" class="form-control" value="{{ old('office_address') }}" placeholder="Office location">
                        @error('office_address')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <!-- Section 4: Membership & Payment -->
            <div class="form-section" style="background: #fafbfc;">
                <div class="section-header">
                    <div class="section-number">4</div>
                    <div>
                        <div class="section-title"><i class="fas fa-credit-card me-2"></i>Membership Selection</div>
                        <div class="section-subtitle">Choose your membership plan</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Membership Type <sup class="text-danger">*</sup></label>
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <label class="membership-card">
                                    <input type="radio" name="membership_type" value="General" data-fee="{{ $fees['General']['fee'] ?? 0 }}" {{ old('membership_type')=='General' ? 'checked' : '' }} required>
                                    <div class="card-content">
                                        <i class="fas fa-user-friends" style="font-size: 32px; color: #667eea; margin-bottom: 10px;"></i>
                                        <h5 style="margin: 10px 0 5px; font-size: 18px;">General Member</h5>
                                        <p style="font-size: 13px; color: #718096; margin: 5px 0;">One-time Fee: <strong>৳{{ number_format($fees['General']['fee'] ?? 0) }}</strong></p>
                                        <p style="font-size: 12px; color: #ef4444; margin: 0;"><i class="fas fa-info-circle"></i> + ৳{{ number_format($fees['General']['monthly_fee'] ?? 100) }}/month</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="membership-card">
                                    <input type="radio" name="membership_type" value="Life" data-fee="{{ $fees['Life']['fee'] ?? 0 }}" {{ old('membership_type')=='Life' ? 'checked' : '' }} required>
                                    <div class="card-content">
                                        <i class="fas fa-crown" style="font-size: 32px; color: #f59e0b; margin-bottom: 10px;"></i>
                                        <h5 style="margin: 10px 0 5px; font-size: 18px;">Life Time Member</h5>
                                        <p style="font-size: 13px; color: #718096; margin: 5px 0;">One-time Fee: <strong>৳{{ number_format($fees['Life']['fee'] ?? 0) }}</strong></p>
                                        <p style="font-size: 12px; color: #10b981; margin: 0;"><i class="fas fa-check-circle"></i> No monthly fee</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="membership-card">
                                    <input type="radio" name="membership_type" value="Associate" data-fee="{{ $fees['Associate']['fee'] ?? 0 }}" {{ old('membership_type')=='Associate' ? 'checked' : '' }} required>
                                    <div class="card-content">
                                        <i class="fas fa-handshake" style="font-size: 32px; color: #10b981; margin-bottom: 10px;"></i>
                                        <h5 style="margin: 10px 0 5px; font-size: 18px;">Associate Member</h5>
                                        <p style="font-size: 13px; color: #718096; margin: 5px 0;">One-time Fee: <strong>৳{{ number_format($fees['Associate']['fee'] ?? 0) }}</strong></p>
                                        <p style="font-size: 12px; color: #10b981; margin: 0;"><i class="fas fa-check-circle"></i> No monthly fee</p>
                                    </div>
                                </label>
                            </div>
                            {{-- <div class="col-md-6 col-lg-3">
                                <label class="membership-card">
                                    <input type="radio" name="membership_type" value="Founder" data-fee="{{ $fees['Founder']['fee'] ?? 0 }}" {{ old('membership_type')=='Founder' ? 'checked' : '' }} required>
                                    <div class="card-content">
                                        <i class="fas fa-medal" style="font-size: 32px; color: #dc2626; margin-bottom: 10px;"></i>
                                        <h5 style="margin: 10px 0 5px; font-size: 18px;">Founder Member</h5>
                                        <p style="font-size: 13px; color: #718096; margin: 5px 0;">One-time Fee: <strong>৳{{ number_format($fees['Founder']['fee'] ?? 0) }}</strong></p>
                                        <p style="font-size: 12px; color: #10b981; margin: 0;"><i class="fas fa-check-circle"></i> No monthly fee</p>
                                    </div>
                                </label>
                            </div> --}}
                        </div>
                        @error('membership_type')<small class="text-danger d-block mt-2">{{ $message }}</small>@enderror

                        <!-- Info Alert -->
                        <div class="alert alert-info mt-3" style="border-radius: 10px; border-left: 4px solid #3b82f6;">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> General Members will have a monthly contribution of ৳{{ number_format($fees['General']['monthly_fee'] ?? 100) }} after approval, which will be tracked separately.
                        </div>
                    </div>

                    <!-- Hidden field for payment type (always membership_fee for new registrations) -->
                    <input type="hidden" name="payment_type" value="membership_fee">

                    <div class="col-md-12">
                        <label class="form-label"><i class="fas fa-wallet input-icon"></i>Payment Method <sup class="text-danger">*</sup></label>
                        <select name="payment_method" class="form-select" required>
                            <option value="">Select Payment Method</option>
                            <option value="bkash" {{ old('payment_method')=='bkash' ? 'selected' : '' }}>bKash Payment</option>
                            <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash Payment (Pay at Office)</option>
                            <option value="bank_transfer" {{ old('payment_method')=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                        <small class="help-text">Select how you want to pay the membership fee</small>
                        @error('payment_method')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-12">
                        <div class="total-amount-box" id="totalAmountBox">
                            <h5>Membership Fee to Pay</h5>
                            <div class="amount">৳<span id="totalAmount">{{ number_format($fees['General']['fee'] ?? 0) }}</span></div>
                            <small style="opacity: 0.9; font-size: 13px; display: block; margin-top: 5px;">
                                This is a one-time membership registration fee
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('home') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const membershipTypeInputs = document.querySelectorAll('input[name="membership_type"]');
    const totalAmountBox = document.getElementById('totalAmountBox');
    const totalAmountSpan = document.getElementById('totalAmount');

    // Handle membership type selection
    membershipTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fee = parseInt(this.dataset.fee) || 0;

            // Remove selected class from all membership cards
            document.querySelectorAll('.membership-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to current card
            this.closest('.membership-card').classList.add('selected');

            // Update total amount display
            if (totalAmountSpan) {
                totalAmountSpan.textContent = fee.toLocaleString();
            }
        });
    });

    // Initialize: trigger change event on page load if membership type is selected
    const checkedMembershipType = document.querySelector('input[name="membership_type"]:checked');
    if (checkedMembershipType) {
        checkedMembershipType.dispatchEvent(new Event('change'));
    } else {
        // Default to first option if none selected
        if (membershipTypeInputs.length > 0) {
            membershipTypeInputs[0].checked = true;
            membershipTypeInputs[0].dispatchEvent(new Event('change'));
        }
    }
});
</script>
@endsection
