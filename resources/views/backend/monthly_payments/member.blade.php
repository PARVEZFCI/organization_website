@extends('backend.admin-layout')
@section('title', 'Member Monthly Payments - Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert"><i class="icon-check"></i></div>
                        <div class="alert-message"><span>{{ session('success') }}</span></div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon"><i class="icon-close"></i></div>
                        <div class="alert-message"><span>{{ session('error') }}</span></div>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon"><i class="icon-info"></i></div>
                        <div class="alert-message"><span>{{ session('info') }}</span></div>
                    </div>
                </div>
            @endif

            <br>

            <!-- Member Info Card -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fa fa-user"></i> Member Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $membership->full_name }}</p>
                                    <p><strong>Mobile:</strong> {{ $membership->mobile }}</p>
                                    <p><strong>Email:</strong> {{ $membership->email ?? 'N/A' }}</p>
                                    <p><strong>Membership Type:</strong> <span class="badge badge-info">{{ $membership->membership_type }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>One-time Fee:</strong> ৳{{ number_format($membership->amount, 2) }}</p>
                                    <p><strong>Total Monthly Paid:</strong> ৳{{ number_format($membership->total_monthly_paid, 2) }}</p>
                                    <p><strong>Total Monthly Due:</strong> ৳{{ number_format($membership->total_monthly_due, 2) }}</p>
                                    <p><strong>Total Earnings:</strong> <span class="text-success">৳{{ number_format($membership->total_earnings, 2) }}</span></p>
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('Admin.membership.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to Members
                                </a>
                                <form method="POST" action="{{ route('Admin.monthly_payments.generate_missing', $membership->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa fa-sync"></i> Generate Missing Payments
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('Admin.monthly_payments.generate_next', $membership->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-plus"></i> Generate Next Month
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments Table -->
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex align-items-center justify-content-between">
                        <span><i class="fa fa-list"></i> Monthly Payment Records</span>
                        <span class="badge badge-light">{{ $payments->count() }} record(s)</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Period</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Paid At</th>
                                        <th>Payment Method</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $payment)
                                        <tr class="{{ $payment->status === 'due' && $payment->isOverdue() ? 'table-danger' : '' }}">
                                            <td>
                                                <strong>{{ $payment->period }}</strong>
                                                @if($payment->isOverdue() && $payment->status === 'due')
                                                    <br><small class="text-danger"><i class="fa fa-exclamation-triangle"></i> Overdue</small>
                                                @endif
                                            </td>
                                            <td>৳{{ number_format($payment->amount, 2) }}</td>
                                            <td>
                                                @if($payment->status === 'paid')
                                                    <span class="badge badge-success"><i class="fa fa-check"></i> Paid</span>
                                                @else
                                                    <span class="badge badge-warning"><i class="fa fa-clock"></i> Due</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->paid_at ? $payment->paid_at->format('d M Y, h:i A') : '-' }}</td>
                                            <td>{{ $payment->payment_method ?? '-' }}</td>
                                            <td>{{ $payment->remarks ?? '-' }}</td>
                                            <td>
                                                @if($payment->status === 'due')
                                                    <button type="button"
                                                            class="btn btn-sm btn-success"
                                                            data-toggle="modal"
                                                            data-target="#markPaidModal{{ $payment->id }}">
                                                        <i class="fa fa-check"></i> Mark Paid
                                                    </button>
                                                @else
                                                    <form method="POST"
                                                          action="{{ route('Admin.monthly_payments.mark_due', $payment->id) }}"
                                                          style="display:inline;">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="return confirm('Are you sure you want to mark this as due?')">
                                                            <i class="fa fa-undo"></i> Unpay
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Mark Paid Modal -->
                                        <div class="modal fade" id="markPaidModal{{ $payment->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('Admin.monthly_payments.mark_paid', $payment->id) }}">
                                                        @csrf
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title">Mark Payment as Paid</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-info">
                                                                <strong>Period:</strong> {{ $payment->period }}<br>
                                                                <strong>Amount:</strong> ৳{{ number_format($payment->amount, 2) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Payment Method <span class="text-danger">*</span></label>
                                                                <select name="payment_method" class="form-control" required>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="bkash">bKash</option>
                                                                    <option value="nagad">Nagad</option>
                                                                    <option value="bank_transfer">Bank Transfer</option>
                                                                    <option value="card">Card</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Remarks (Optional)</label>
                                                                <textarea name="remarks" class="form-control" rows="3" placeholder="Add any notes about this payment..."></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Transaction ID (Optional)</label>
                                                                <input type="text" name="transaction_id" class="form-control" placeholder="For bKash or bank reference">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fa fa-check"></i> Confirm Payment
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p class="mb-2">No payment records found for this member.</p>
                                                <form method="POST" action="{{ route('Admin.monthly_payments.generate_missing', $membership->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i> Generate Payment Records
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($payments->count() > 0)
                                    <tfoot class="bg-light">
                                        <tr>
                                            <td colspan="2"><strong>Summary</strong></td>
                                            <td colspan="5">
                                                <span class="badge badge-success">Paid: ৳{{ number_format($membership->total_monthly_paid, 2) }}</span>
                                                <span class="badge badge-warning">Due: ৳{{ number_format($membership->total_monthly_due, 2) }}</span>
                                                <span class="badge badge-info">Total: ৳{{ number_format($membership->total_monthly_paid + $membership->total_monthly_due, 2) }}</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
