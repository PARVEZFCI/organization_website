@extends('backend.admin-layout')
@section('title', 'Past Committee Periods - Dashboard')
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
                        <i class="fa fa-history"></i>
                        Past Committee Periods
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                All Periods
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.past-committee-periods.create') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> Add New Period
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Years</th>
                                            <th>Sort Order</th>
                                            <th>Status</th>
                                            <th>Members</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($periods as $period)
                                            <tr>
                                                <td>{{ $period->id }}</td>
                                                <td>{{ $period->title }}</td>
                                                <td>
                                                    @if($period->start_year || $period->end_year)
                                                        {{ $period->start_year ?? '...' }} - {{ $period->end_year ?? '...' }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $period->sort_order }}</td>
                                                <td>
                                                    <span class="badge {{ $period->status ? 'badge-success' : 'badge-secondary' }}">
                                                        {{ $period->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>{{ $period->members_count }}</td>
                                                <td>
                                                    <a href="{{ route('Admin.past-committee-periods.show', $period) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-users"></i> Members
                                                    </a>
                                                    <a href="{{ route('Admin.past-committee-periods.edit', $period) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('Admin.past-committee-periods.destroy', $period) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deleting a period will also delete its members. Continue?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No past committee periods found</td>
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
    </div>
@endsection
