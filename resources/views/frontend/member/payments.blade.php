@extends('frontend.member.layouts.dashboard')

@section('title', 'Payment History')
@section('page-title', 'Payment History')

@section('content')
<!-- Payment Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Membership Fee</p>
                    <h3 class="stat-value">৳{{ number_format($member->amount) }}</h3>
                    <small class="text-muted">{{ ucfirst($member->payment_method) }} | {{ ucfirst($member->membership_type) }}</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Monthly Paid</p>
                    <h3 class="stat-value text-success">৳{{ number_format($totalPaid) }}</h3>
                    <small class="text-success">{{ $payments->where('status', 'paid')->count() }} payment(s) completed</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #38b2ac, #2f855a);">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Monthly Due</p>
                    <h3 class="stat-value text-danger">৳{{ number_format($totalDue) }}</h3>
                    <small class="text-danger">{{ $payments->where('status', 'due')->count() }} payment(s) pending</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #fc8181, #e53e3e);">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Table -->
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i>All Monthly Payments</span>
        <span class="badge bg-secondary">{{ $payments->count() }} records</span>
    </div>
    <div class="card-body p-0">
        @if($payments->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Period</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Paid Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $payment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
                        <td>{{ $payment->payment_method ? ucfirst($payment->payment_method) : '-' }}</td>
                        <td>{{ $payment->paid_at ? $payment->paid_at->format('d M, Y') : '-' }}</td>
                        <td>{{ $payment->remarks ?? '-' }}</td>
                        <td>
                            @if($payment->status === 'due')
                                <form action="{{ route('member.payments.bkash') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-bolt me-1"></i>Pay Now
                                    </button>
                                </form>
                            @else
                                <span class="text-success small fw-semibold">Paid</span>
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
            <p class="mb-1">No monthly payments recorded.</p>
            <small>Monthly payments are generated for General members.</small>
        </div>
        @endif
    </div>
</div>
@endsection
