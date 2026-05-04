@extends('backend.admin-layout')
@section('title', 'Monthly Payments - Dashboard')
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

            <br>

            <!-- Summary Cards -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-hourglass-half"></i> Total Due</h5>
                            <h3>৳{{ number_format($totalDue, 2) }}</h3>
                            <p class="mb-0">{{ $dueCount }} payment(s) pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-check-circle"></i> Total Paid</h5>
                            <h3>৳{{ number_format($totalPaid, 2) }}</h3>
                            <p class="mb-0">From monthly payments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-calculator"></i> Total Expected</h5>
                            <h3>৳{{ number_format($totalDue + $totalPaid, 2) }}</h3>
                            <p class="mb-0">Overall monthly revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex align-items-center justify-content-between">
                        <span><i class="fa fa-money-bill-wave"></i> Monthly Payments</span>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <form method="GET" action="{{ route('Admin.monthly_payments.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="">All Status</option>
                                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="due" {{ request('status') == 'due' ? 'selected' : '' }}>Due</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="member_id" class="form-control">
                                        <option value="">All Members</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                                                {{ $member->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="month" class="form-control">
                                        <option value="">All Months</option>
                                        @for($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="year" class="form-control">
                                        <option value="">All Years</option>
                                        @for($y = date('Y'); $y >= 2020; $y--)
                                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Member Name</th>
                                        <th>Period</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Paid At</th>
                                        <th>Payment Method</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $payment)
                                        <tr>
                                            <td>
                                                <a href="{{ route('Admin.monthly_payments.member', $payment->membership_id) }}">
                                                    {{ $payment->membership->full_name }}
                                                </a>
                                            </td>
                                            <td>{{ $payment->period }}</td>
                                            <td>৳{{ number_format($payment->amount, 2) }}</td>
                                            <td>
                                                @if($payment->status === 'paid')
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <span class="badge badge-warning">Due</span>
                                                    @if($payment->isOverdue())
                                                        <span class="badge badge-danger">Overdue</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{ $payment->paid_at ? $payment->paid_at->format('d M Y') : '-' }}
                                            </td>
                                            <td>{{ $payment->payment_method ?? '-' }}</td>
                                            <td>
                                                @if($payment->status === 'due')
                                                    <button type="button" class="btn btn-sm btn-success"
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
                                                                onclick="return confirm('Mark as due?')">
                                                            <i class="fa fa-times"></i> Mark Due
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
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Mark Payment as Paid</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Member:</strong> {{ $payment->membership->full_name }}</p>
                                                            <p><strong>Period:</strong> {{ $payment->period }}</p>
                                                            <p><strong>Amount:</strong> ৳{{ number_format($payment->amount, 2) }}</p>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label>Payment Method</label>
                                                                <select name="payment_method" class="form-control">
                                                                    <option value="cash">Cash</option>
                                                                    <option value="bkash">bKash</option>
                                                                    <option value="bank_transfer">Bank Transfer</option>
                                                                    <option value="card">Card</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Remarks (Optional)</label>
                                                                <textarea name="remarks" class="form-control" rows="2"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Transaction ID (Optional)</label>
                                                                <input type="text" name="transaction_id" class="form-control" placeholder="For bKash or bank reference">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Confirm Payment</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No monthly payments found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $payments->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
