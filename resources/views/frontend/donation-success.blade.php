@extends('frontend.layouts.app')

@section('title', 'Donation Successful - Thank You!')

@section('content')
<style>
    .success-hero {
        background: linear-gradient(135deg, #9aa316 0%, #848a2e 100%);
        padding: 60px 0;
        color: white;
        margin-bottom: 50px;
    }

    .success-icon {
        font-size: 5rem;
        margin-bottom: 20px;
        animation: scaleIn 0.5s ease-in-out;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .invoice-section {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
        margin-bottom: 40px;
    }

    .invoice-header {
        border-bottom: 3px solid #16a34a;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .invoice-header h2 {
        color: #16a34a;
        font-weight: 700;
    }

    .invoice-details {
        margin: 30px 0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row:last-child {
        border-bottom: 2px solid #16a34a;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .detail-label {
        color: #4b5563;
        font-weight: 600;
    }

    .detail-value {
        color: #1f2937;
        font-weight: 500;
    }

    .amount-highlight {
        color: #16a34a;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .action-buttons {
        margin-top: 40px;
        text-align: center;
    }

    .action-buttons .btn {
        margin: 10px;
        padding: 12px 30px;
    }

    .thank-you-message {
        background: #f0fdf4;
        border-left: 4px solid #16a34a;
        padding: 20px;
        margin: 30px 0;
        border-radius: 5px;
    }

    .social-share {
        text-align: center;
        margin: 30px 0;
    }

    .social-share h5 {
        margin-bottom: 20px;
        color: #4b5563;
    }

    .social-btn {
        display: inline-block;
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50%;
        margin: 0 10px;
        color: white;
        font-size: 1.5rem;
        text-align: center;
        transition: transform 0.3s;
    }

    .social-btn:hover {
        transform: scale(1.1);
    }

    .social-btn.facebook {
        background: #1877f2;
    }

    .social-btn.twitter {
        background: #1da1f2;
    }

    .social-btn.whatsapp {
        background: #25d366;
    }

    .print-btn {
        background: #6b7280;
    }

    @media print {
        .action-buttons, .social-share, .navbar, .footer {
            display: none !important;
        }

        .invoice-section {
            box-shadow: none;
        }
    }
</style>

<div class="success-hero">
    <div class="container text-center">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 style="font-size: 2.5rem; margin-bottom: 15px;">Payment Successful!</h1>
        <p style="font-size: 1.2rem;">Thank you for your generous donation</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Invoice Section -->
            <div class="invoice-section">
                <div class="invoice-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2>DONATION RECEIPT</h2>
                            <p class="mb-0">Invoice #{{ $donation->id ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            @php
                                $settings = \App\Models\Setting::first();
                            @endphp
                            <h4>{{ $settings->company_name ?? 'Dream Youth Club' }}</h4>
                            <p class="mb-0">{{ $settings->address ?? 'Dhaka, Bangladesh' }}</p>
                            <p class="mb-0">{{ $settings->phone ?? 'N/A' }}</p>
                            <p class="mb-0">{{ $settings->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="invoice-details">
                    <h5 class="mb-3" style="color: #16a34a;">Transaction Details</h5>

                    <div class="detail-row">
                        <span class="detail-label">Transaction ID:</span>
                        <span class="detail-value">{{ $donation->trx_id ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Payment ID:</span>
                        <span class="detail-value">{{ $donation->payment_id ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Date & Time:</span>
                        <span class="detail-value">{{ $donation->updated_at ? $donation->updated_at->format('F d, Y h:i A') : 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Donation Fund:</span>
                        <span class="detail-value">{{ ucwords(str_replace('_', ' ', $donation->donation_fund ?? 'N/A')) }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Contact:</span>
                        <span class="detail-value">{{ $donation->phone_email ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Payment Method:</span>
                        <span class="detail-value">bKash</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value">
                            <span class="badge bg-success">{{ $donation->transaction_status ?? 'Completed' }}</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Donation Amount:</span>
                        <span class="amount-highlight">৳{{ number_format($donation->amount ?? 0, 2) }} BDT</span>
                    </div>
                </div>

                <div class="thank-you-message">
                    <h5 style="color: #16a34a; margin-bottom: 15px;">
                        <i class="fas fa-heart"></i> Thank You For Your Generosity!
                    </h5>
                    <p class="mb-2">Your donation will help us continue our mission to empower youth and build stronger communities. We are deeply grateful for your support.</p>
                    <p class="mb-0"><strong>Tax Benefit:</strong> This donation is eligible for tax relief. Please keep this receipt for your records.</p>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button onclick="window.print()" class="btn print-btn">
                        <i class="fas fa-print"></i> Print Receipt
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-primary-custom">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                    <a href="{{ route('donation.page') }}" class="btn btn-success">
                        <i class="fas fa-hand-holding-heart"></i> Donate Again
                    </a>
                </div>

                <!-- Social Share -->
                <div class="social-share">
                    <h5>Share Your Good Deed</h5>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=I just made a donation to Dream Youth Club!&url={{ url()->current() }}" target="_blank" class="social-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text=I just made a donation to Dream Youth Club! {{ url()->current() }}" target="_blank" class="social-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Facebook Pixel Code for Conversion Tracking -->
<script>
    // Facebook Pixel Purchase Event
    @if(isset($donation))
    fbq('track', 'Purchase', {
        value: {{ $donation->amount }},
        currency: 'BDT',
        content_name: 'Donation',
        content_category: '{{ $donation->donation_fund }}',
        content_ids: ['{{ $donation->id }}'],
    });

    // Alternative: Donate Event
    fbq('track', 'Donate', {
        value: {{ $donation->amount }},
        currency: 'BDT'
    });
    @endif
</script>

@endsection
