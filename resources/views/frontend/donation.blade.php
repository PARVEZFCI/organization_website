@extends('frontend.layouts.app')

@section('title', 'Make a Donation - Dream Youth Club')

@section('content')
<style>
    .donation-hero {
    background: linear-gradient(rgb(147 146 55), rgb(134 147 61)), url(https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=1200);        background-size: cover;
        background-size: cover;
        background-position: center;
        padding: 80px 0 60px;
        color: white;
        margin-bottom: 50px;
    }

    .donation-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .donation-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .donation-section {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
        margin-bottom: 40px;
    }

    .bank-details-section {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        margin-top: 40px;
    }

    .bank-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 20px;
        border-left: 4px solid #919238;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .bank-card h5 {
        color: #919238;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .bank-info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .bank-info-row:last-child {
        border-bottom: none;
    }

    .bank-info-label {
        font-weight: 600;
        color: #4b5563;
    }

    .bank-info-value {
        color: #1f2937;
        font-family: monospace;
    }

    .donation-impact {
    background: linear-gradient(rgb(147 146 55), rgb(134 147 61));
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin: 40px 0;
    }

    .impact-item {
        text-align: center;
        padding: 20px;
    }

    .impact-item i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .impact-item h4 {
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    .copy-btn {
        cursor: pointer;
        color: #798d33;
        margin-left: 10px;
        font-size: 0.9rem;
    }

    .copy-btn:hover {
        color: #919238;
    }
</style>

<!-- Hero Section -->
<div class="donation-hero">
    <div class="container text-center">
        <h1>Make a Difference Today</h1>
        <p>Your generous donation helps us continue our mission to empower youth and build stronger communities</p>
    </div>
</div>

<div class="container">
    <!-- Donation Form Section -->
    <div class="donation-section">
        <h3 class="text-center mb-4" style="color: #919238; font-weight: 700;">Make Your Donation</h3>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('bkash.create') }}" method="POST" id="donationForm">
            @csrf
            <div class="row g-3">
                <div class="col-lg-6 col-md-6">
                    <label class="form-label fw-bold">Donation Fund <sup style="color: red;">*</sup></label>
                    <select class="form-select" name="donation_fund" required>
                        <option value="">Select Donation Fund</option>
                        <option value="general_fund">General Fund</option>
                        <option value="education_fund">Education Fund</option>
                        <option value="healthcare_fund">Healthcare Fund</option>
                        <option value="orphan_support">Orphan Support</option>
                        <option value="skill_development">Skill Development</option>
                        <option value="emergency_relief">Emergency Relief</option>
                    </select>
                    @error('donation_fund')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6">
                    <label class="form-label fw-bold">Phone / Email <sup style="color: red;">*</sup></label>
                    <input type="text" class="form-control" name="phone_email" placeholder="Enter your mobile number or email" required>
                    @error('phone_email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6">
                    <label class="form-label fw-bold">Donation Amount <sup style="color: red;">*</sup> <small class="text-muted">(Minimum: ৳10)</small></label>
                    <input type="number" class="form-control" name="amount" placeholder="৳ Enter amount in BDT" min="10" required>
                    @error('amount')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6">
                    <label class="form-label fw-bold">Message (Optional)</label>
                    <input type="text" class="form-control" name="message" placeholder="Leave a message (optional)">
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary-custom" style="padding: 15px 50px; font-size: 1.1rem;">
                        <i class="fas fa-hand-holding-heart"></i> Donate via bKash
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-4 mb-0" style="color: #333; font-size: 0.95rem;">
            <i class="fas fa-shield-alt text-success"></i> Secure payment via bKash | You will receive tax relief when you donate to Dream Youth Club.
        </p>
    </div>

    <!-- Donation Impact Section -->
    <div class="donation-impact">
        <h3 class="text-center mb-4">Your Impact</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="impact-item">
                    <i class="fas fa-graduation-cap"></i>
                    <h4>Education Support</h4>
                    <p>Help provide quality education and training to underprivileged youth</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-item">
                    <i class="fas fa-hands-helping"></i>
                    <h4>Community Development</h4>
                    <p>Support programs that strengthen and uplift local communities</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="impact-item">
                    <i class="fas fa-heart"></i>
                    <h4>Emergency Relief</h4>
                    <p>Provide immediate assistance to those in urgent need</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Details Section -->
    <div class="bank-details-section">
        <h3 class="text-center mb-4" style="color: #919238; font-weight: 700;">
            <i class="fas fa-university"></i> Alternative Payment Method - Bank Transfer
        </h3>
        <p class="text-center mb-4">You can also donate directly through bank transfer using the following details:</p>

        <div class="row">
            <div class="col-md-6">
                <div class="bank-card">
                    <h5><i class="fas fa-building"></i> Primary Bank Account</h5>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Bank Name:</span>
                        <span class="bank-info-value">Dutch Bangla Bank Limited</span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Branch:</span>
                        <span class="bank-info-value">Gulshan Branch</span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Account Name:</span>
                        <span class="bank-info-value">Dream Youth Club</span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Account Number:</span>
                        <span class="bank-info-value">
                            123-456-789012
                            <i class="fas fa-copy copy-btn" onclick="copyToClipboard('123-456-789012')" title="Copy"></i>
                        </span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Routing Number:</span>
                        <span class="bank-info-value">
                            090270123
                            <i class="fas fa-copy copy-btn" onclick="copyToClipboard('090270123')" title="Copy"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bank-card">
                    <h5><i class="fas fa-mobile-alt"></i> Mobile Banking</h5>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Service:</span>
                        <span class="bank-info-value">Nagad</span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Account Type:</span>
                        <span class="bank-info-value">Personal</span>
                    </div>
                    <div class="bank-info-row">
                        <span class="bank-info-label">Account Number:</span>
                        <span class="bank-info-value">
                            01841131316
                            <i class="fas fa-copy copy-btn" onclick="copyToClipboard('01841131316')" title="Copy"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-warning mt-4">
            <i class="fas fa-exclamation-triangle"></i> <strong>Important:</strong> After making a bank transfer, please contact us with your transaction details at <strong>+880 1841-131316</strong> or email <strong>info@dreamyouthclub.org</strong> to confirm your donation.
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Copied to clipboard: ' + text);
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>

@endsection
