@extends('frontend.member.layouts.dashboard')

@section('title', 'Member Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Membership Fee</p>
                    <h3 class="stat-value">৳{{ number_format($membershipFee) }}</h3>
                    <small class="text-success"><i class="fas fa-check-circle"></i> Paid</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Monthly Paid</p>
                    <h3 class="stat-value">৳{{ number_format($totalPaid) }}</h3>
                    <small class="text-muted">{{ $paidCount }} payment(s)</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #38b2ac, #2f855a);">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Monthly Due</p>
                    <h3 class="stat-value text-danger">৳{{ number_format($totalDue) }}</h3>
                    <small class="text-danger">{{ $dueCount }} pending</small>
                    @if($member->requiresMonthlyPayments() && $currentDuePayment)
                        <form action="{{ route('member.payments.bkash') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="payment_id" value="{{ $currentDuePayment->id }}">
                            <button type="submit" class="btn btn-sm btn-danger">Pay Now</button>
                        </form>
                    @endif
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #fc8181, #e53e3e);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Paid</p>
                    <h3 class="stat-value">৳{{ number_format($membershipFee + $totalPaid) }}</h3>
                    <small class="text-muted">All-time</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #ed8936, #dd6b20);">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info + Recent Payments Row -->
<div class="row g-4">
    <!-- Member Info Card -->
    <div class="col-lg-5">
        <div class="card-custom h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-user me-2"></i>My Information</span>
                <a href="{{ route('member.profile') }}" class="btn btn-sm btn-outline-primary">Edit</a>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($member->profile_picture)
                        <img src="{{ url($member->profile_picture) }}" alt="{{ $member->full_name }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->full_name) }}&background=667eea&color=fff&size=80" class="rounded-circle" alt="{{ $member->full_name }}">
                    @endif
                </div>
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted" style="width:40%">Name</td><td class="fw-semibold">{{ $member->full_name }}</td></tr>
                    <tr><td class="text-muted">Email</td><td>{{ $member->email }}</td></tr>
                    <tr><td class="text-muted">Mobile</td><td>{{ $member->mobile }}</td></tr>
                    <tr><td class="text-muted">Type</td><td><span class="badge bg-primary">{{ $member->membership_type }}</span></td></tr>
                    <tr><td class="text-muted">Course</td><td>{{ $member->course_name ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted">Intake</td><td>{{ $member->intake_no ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted">Passing Year</td><td>{{ $member->passing_year ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted">Organization</td><td>{{ $member->organization ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted">Payment Method</td><td>{{ ucfirst($member->payment_method) }}</td></tr>
                    <tr><td class="text-muted">Status</td><td><span class="badge bg-success">{{ ucfirst($member->status) }}</span></td></tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Monthly Payments -->
    <div class="col-lg-7">
        <div class="card-custom h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-history me-2"></i>Recent Monthly Payments</span>
                <a href="{{ route('member.payments') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if($member->monthlyPayments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Period</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Paid Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->monthlyPayments->sortByDesc(function($p){ return $p->year * 100 + $p->month; })->take(6) as $payment)
                            <tr>
                                <td class="fw-semibold">{{ $payment->period }}</td>
                                <td>৳{{ number_format($payment->amount) }}</td>
                                <td>
                                    @if($payment->status === 'paid')
                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Paid</span>
                                    @elseif($payment->isOverdue())
                                        <span class="badge bg-danger"><i class="fas fa-clock me-1"></i>Overdue</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>Due</span>
                                    @endif
                                </td>
                                <td>{{ $payment->paid_at ? $payment->paid_at->format('d M, Y') : '-' }}</td>
                                <td>
                                    @if($payment->status === 'due')
                                        <form action="{{ route('member.payments.bkash') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">Pay Now</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-receipt fa-3x mb-3 opacity-50"></i>
                    <p>No monthly payments recorded yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-calendar-check me-2"></i>Event Registration History</span>
                <span class="badge bg-primary">{{ $recentEventRegistrations->count() }}</span>
            </div>
            <div class="card-body p-0">
                @if($recentEventRegistrations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Registration Code</th>
                                    <th>Participants</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Registered On</th>
                                    <th>Proof</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentEventRegistrations as $registration)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $registration->event->title ?? 'Event removed' }}</div>
                                            @if(optional($registration->event)->date)
                                                <small class="text-muted">{{ $registration->event->date->format('d M, Y') }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $registration->registration_code }}</td>
                                        <td>{{ $registration->participantSummary() ?: 'N/A' }}</td>
                                        <td>৳{{ number_format((float) $registration->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $registration->payment_status === 'paid' ? 'bg-success' : ($registration->payment_status === 'pending' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                                {{ ucfirst($registration->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $registration->registration_status === 'confirmed' ? 'bg-success' : 'bg-info' }}">
                                                {{ ucfirst(str_replace('_', ' ', $registration->registration_status)) }}
                                            </span>
                                        </td>
                                        <td>{{ optional($registration->created_at)->format('d M, Y') ?? '-' }}</td>
                                        <td>
                                            @if($registration->registration_status === 'confirmed')
                                                <a href="{{ route('member.event-registrations.proof', $registration) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-print me-1"></i> Print PDF
                                                </a>
                                            @else
                                                <span class="text-muted small">Available after confirmation</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-check fa-3x mb-3 opacity-50"></i>
                        <p class="mb-0">No event registration history found yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
