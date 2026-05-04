@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="h4 mb-1">Admin Dashboard</h2>
                    <p class="text-muted mb-0">Overview of your system performance and membership activity.</p>
                </div>
                <div>
                    <span class="badge bg-secondary p-2 text-uppercase fs-7">Last updated: {{ now()->format('F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($totalMembers) }}</h3>
                            <p class="text-muted mb-0">Total members registered</p>
                        </div>
                        <div class="badge rounded-pill bg-primary p-3 shadow-sm">
                            <i class="fas fa-user-friends fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($activeMembers) }}</h3>
                            <p class="text-muted mb-0">Active memberships</p>
                        </div>
                        <div class="badge rounded-pill bg-success p-3 shadow-sm">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($newMembersThisMonth) }}</h3>
                            <p class="text-muted mb-0">New members this month</p>
                        </div>
                        <div class="badge rounded-pill bg-info p-3 shadow-sm">
                            <i class="fas fa-calendar-alt fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($totalRevenue, 2) }}</h3>
                            <p class="text-muted mb-0">Total revenue collected</p>
                        </div>
                        <div class="badge rounded-pill bg-warning p-3 shadow-sm">
                            <i class="fas fa-dollar-sign fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($totalDue, 2) }}</h3>
                            <p class="text-muted mb-0">Outstanding dues</p>
                        </div>
                        <div class="badge rounded-pill bg-danger p-3 shadow-sm">
                            <i class="fas fa-exclamation-triangle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="mb-1">{{ number_format($duePaymentsThisMonth) }}</h3>
                            <p class="text-muted mb-0">Due payments this month</p>
                        </div>
                        <div class="badge rounded-pill bg-secondary p-3 shadow-sm">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Latest Registered Members</h5>
                        <small class="text-muted">Most recent membership applications and account details.</small>
                    </div>
                    <span class="badge bg-primary">Showing latest 10</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestMembers as $member)
                                    <tr>
                                        <td>{{ $member->id }}</td>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->email ?? '—' }}</td>
                                        <td>{{ $member->mobile ?? '—' }}</td>
                                        <td>{{ $member->membership_type ?? '—' }}</td>
                                        <td>{{ number_format($member->amount, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $member->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($member->status ?? 'unknown') }}
                                            </span>
                                        </td>
                                        <td>{{ optional($member->created_at)->format('Y-m-d') ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No recent members found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
