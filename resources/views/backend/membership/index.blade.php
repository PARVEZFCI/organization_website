@extends('backend.admin-layout')
@section('title', 'Memberships - Dashboard')
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

            <br>

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-users"></i>
                        All Members
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Members List
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>NID/Passport</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Membership Type</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($memberships as $membership)
                                            <tr>
                                                <td>{{ $membership->id }}</td>
                                                <td>{{ $membership->full_name }}</td>
                                                <td>{{ $membership->nid_passport_no ?? 'N/A' }}</td>
                                                <td>{{ $membership->email ?? 'N/A' }}</td>
                                                <td>{{ $membership->mobile }}</td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $membership->membership_type }}</span>
                                                </td>
                                                <td>
                                                    @if($membership->status == 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $membership->amount ?? 'N/A' }}</td>
                                                <td>{{ $membership->payment_method ?? 'N/A' }}</td>
                                                <td>{{ $membership->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('Admin.membership.edit', $membership->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('Admin.membership.destroy', $membership->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center text-muted">No members found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <nav aria-label="Page navigation" class="mt-4">
                                {{ $memberships->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
