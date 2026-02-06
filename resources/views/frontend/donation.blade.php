@extends('frontend.layouts.app')

@section('title', 'Make a Donation - BESWA')

@section('content')
<style>
.donation-wrapper {
    padding: 60px 0;
    margin-top: -20px;
}
.donation-form-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    overflow: hidden;
}
.donation-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 50px 30px;
    text-align: center;
}
.donation-header h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
}
.donation-header p {
    font-size: 18px;
    opacity: 0.95;
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
}
.form-section {
    padding: 40px 40px;
}
.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
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
.donation-fund-card {
    padding: 15px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
}
.donation-fund-card:hover {
    border-color: #667eea;
    background: #f7fafc;
    transform: translateX(5px);
}
.donation-fund-card.selected {
    border-color: #667eea;
    background: #f0f4ff;
}
.donation-fund-card input[type="radio"] {
    margin-right: 12px;
    width: 20px;
    height: 20px;
    cursor: pointer;
}
.fund-info {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 12px;
}
.fund-icon {
    font-size: 28px;
    color: #667eea;
    min-width: 40px;
}
.fund-details h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #2d3748;
}
.fund-details p {
    margin: 0;
    font-size: 12px;
    color: #718096;
}
.quick-amount-btn {
    padding: 12px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    background: white;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    color: #4a5568;
    text-align: center;
}
.quick-amount-btn:hover {
    border-color: #667eea;
    background: #f0f4ff;
    color: #667eea;
}
.quick-amount-btn.active {
    border-color: #667eea;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.form-actions {
    background: #f7fafc;
    padding: 25px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn-donate {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 16px 50px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 18px;
    transition: all 0.3s;
    width: 100%;
}
.btn-donate:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    color: white;
}
.impact-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 50px 40px;
}
.impact-item {
    text-align: center;
    padding: 20px;
}
.impact-item i {
    font-size: 48px;
    margin-bottom: 15px;
    opacity: 0.95;
}
.impact-item h5 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}
.impact-item p {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}
.bank-section {
    background: #fafbfc;
    padding: 40px;
}
.bank-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    margin-bottom: 20px;
    transition: all 0.3s;
}
.bank-card:hover {
    border-color: #667eea;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.1);
}
.bank-card h5 {
    color: #667eea;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 18px;
}
.bank-info-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}
.bank-info-row:last-child {
    border-bottom: none;
}
.bank-info-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 14px;
}
.bank-info-value {
    color: #2d3748;
    font-family: 'Courier New', monospace;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.copy-btn {
    cursor: pointer;
    color: #667eea;
    font-size: 16px;
    transition: all 0.2s;
}
.copy-btn:hover {
    color: #764ba2;
    transform: scale(1.1);
}
.help-text {
    font-size: 12px;
    color: #a0aec0;
    margin-top: 5px;
}
</style>

<div class="donation-wrapper">
    <div class="donation-form-container">
        <div class="donation-header">
            <h2><i class="fas fa-hand-holding-heart"></i> Make a Difference</h2>
            <p>Your generous donation helps us empower youth and build stronger communities together</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success m-4 rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger m-4 rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
        @endif

        <form action="{{ route('bkash.create') }}" method="POST" id="donationForm">
            @csrf

            <!-- Donation Fund Selection -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-number">1</div>
                    <div>
                        <div class="section-title"><i class="fas fa-hands-helping me-2"></i>Choose Donation Fund</div>
                        <div class="section-subtitle">Select where you'd like your donation to make an impact</div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="general_fund" required>
                            <div class="fund-info">
                                <i class="fas fa-globe fund-icon"></i>
                                <div class="fund-details">
                                    <h6>General Fund</h6>
                                    <p>Support all areas of our mission</p>
                                </div>
                            </div>
                        </label>

                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="education_fund" required>
                            <div class="fund-info">
                                <i class="fas fa-graduation-cap fund-icon"></i>
                                <div class="fund-details">
                                    <h6>Education Fund</h6>
                                    <p>Provide quality education and training</p>
                                </div>
                            </div>
                        </label>

                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="healthcare_fund" required>
                            <div class="fund-info">
                                <i class="fas fa-heartbeat fund-icon" style="color: #ef4444;"></i>
                                <div class="fund-details">
                                    <h6>Healthcare Fund</h6>
                                    <p>Support health and medical services</p>
                                </div>
                            </div>
                        </label>

                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="orphan_support" required>
                            <div class="fund-info">
                                <i class="fas fa-child fund-icon" style="color: #f59e0b;"></i>
                                <div class="fund-details">
                                    <h6>Orphan Support</h6>
                                    <p>Care for orphaned and vulnerable children</p>
                                </div>
                            </div>
                        </label>

                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="skill_development" required>
                            <div class="fund-info">
                                <i class="fas fa-tools fund-icon" style="color: #10b981;"></i>
                                <div class="fund-details">
                                    <h6>Skill Development</h6>
                                    <p>Vocational training and skills programs</p>
                                </div>
                            </div>
                        </label>

                        <label class="donation-fund-card">
                            <input type="radio" name="donation_fund" value="emergency_relief" required>
                            <div class="fund-info">
                                <i class="fas fa-medkit fund-icon" style="color: #8b5cf6;"></i>
                                <div class="fund-details">
                                    <h6>Emergency Relief</h6>
                                    <p>Immediate assistance for urgent needs</p>
                                </div>
                            </div>
                        </label>
                        @error('donation_fund')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <!-- Donation Amount -->
            <div class="form-section" style="background: #fafbfc;">
                <div class="section-header">
                    <div class="section-number">2</div>
                    <div>
                        <div class="section-title"><i class="fas fa-money-bill-wave me-2"></i>Donation Amount</div>
                        <div class="section-subtitle">Choose an amount or enter custom value</div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="500">৳500</button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="1000">৳1,000</button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="2000">৳2,000</button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="5000">৳5,000</button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="10000">৳10,000</button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="quick-amount-btn w-100" data-amount="custom">Custom</button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label"><i class="fas fa-dollar-sign input-icon"></i>Amount <sup class="text-danger">*</sup></label>
                        <input type="number" name="amount" id="donationAmount" class="form-control" placeholder="Enter amount in Taka (৳)" min="10" required>
                        <small class="help-text">Minimum donation amount is ৳10</small>
                        @error('amount')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-number">3</div>
                    <div>
                        <div class="section-title"><i class="fas fa-user me-2"></i>Your Details</div>
                        <div class="section-subtitle">How can we reach you?</div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-phone input-icon"></i>Phone / Email <sup class="text-danger">*</sup></label>
                        <input type="text" name="phone_email" class="form-control" placeholder="Mobile number or email" required>
                        @error('phone_email')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-comment input-icon"></i>Message (Optional)</label>
                        <input type="text" name="message" class="form-control" placeholder="Leave a message">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="btn-donate">
                    <i class="fas fa-heart me-2"></i>Donate via bKash
                </button>
            </div>
        </form>

        <!-- Impact Section -->
        <div class="impact-section">
            <h3 class="text-center mb-4" style="font-size: 28px; font-weight: 700;">Your Impact Matters</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="impact-item">
                        <i class="fas fa-graduation-cap"></i>
                        <h5>Education Support</h5>
                        <p>Help provide quality education and training to underprivileged youth</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-item">
                        <i class="fas fa-users"></i>
                        <h5>Community Development</h5>
                        <p>Support programs that strengthen and uplift local communities</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-item">
                        <i class="fas fa-hand-holding-heart"></i>
                        <h5>Emergency Relief</h5>
                        <p>Provide immediate assistance to those in urgent need</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Transfer Section -->
        <div class="bank-section">
            <div class="section-header mb-4">
                <div class="section-number"><i class="fas fa-university" style="font-size: 20px;"></i></div>
                <div>
                    <div class="section-title">Alternative Payment - Bank Transfer</div>
                    <div class="section-subtitle">You can also donate through direct bank transfer</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="bank-card">
                        <h5><i class="fas fa-building me-2"></i>Primary Bank Account</h5>
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
                            <span class="bank-info-value">BESWA</span>
                        </div>
                        <div class="bank-info-row">
                            <span class="bank-info-label">Account Number:</span>
                            <span class="bank-info-value">
                                123-456-789012
                                <i class="fas fa-copy copy-btn" onclick="copyToClipboard('123-456-789012')" title="Copy to clipboard"></i>
                            </span>
                        </div>
                        <div class="bank-info-row">
                            <span class="bank-info-label">Routing Number:</span>
                            <span class="bank-info-value">
                                090270123
                                <i class="fas fa-copy copy-btn" onclick="copyToClipboard('090270123')" title="Copy to clipboard"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bank-card">
                        <h5><i class="fas fa-mobile-alt me-2"></i>Mobile Banking</h5>
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
                                <i class="fas fa-copy copy-btn" onclick="copyToClipboard('01841131316')" title="Copy to clipboard"></i>
                            </span>
                        </div>
                    </div>

                    <div class="alert alert-info" style="border-radius: 10px; border-left: 4px solid #667eea;">
                        <i class="fas fa-info-circle me-2"></i><strong>Note:</strong> After transfer, contact us at <strong>+880 1841-131316</strong> to confirm your donation.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle donation fund selection
    const fundCards = document.querySelectorAll('.donation-fund-card');
    fundCards.forEach(card => {
        card.addEventListener('click', function() {
            fundCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Handle quick amount buttons
    const quickAmountBtns = document.querySelectorAll('.quick-amount-btn');
    const amountInput = document.getElementById('donationAmount');

    quickAmountBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            quickAmountBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const amount = this.dataset.amount;
            if (amount !== 'custom') {
                amountInput.value = amount;
                amountInput.focus();
            } else {
                amountInput.value = '';
                amountInput.focus();
            }
        });
    });

    // Custom amount input - activate custom button
    amountInput.addEventListener('input', function() {
        const currentValue = parseInt(this.value);
        let matchFound = false;
        
        quickAmountBtns.forEach(btn => {
            if (btn.dataset.amount == currentValue) {
                btn.classList.add('active');
                matchFound = true;
            } else if (btn.dataset.amount !== 'custom') {
                btn.classList.remove('active');
            }
        });
        
        if (!matchFound && this.value) {
            quickAmountBtns.forEach(btn => {
                if (btn.dataset.amount === 'custom') {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }
    });
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Create temporary tooltip
        const tooltip = document.createElement('div');
        tooltip.textContent = 'Copied!';
        tooltip.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #667eea; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; z-index: 9999;';
        document.body.appendChild(tooltip);
        setTimeout(() => document.body.removeChild(tooltip), 1500);
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>

@endsection
