@extends('backend.admin-layout')
@section('title', 'Manage Past Committee Members - Dashboard')
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

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-users"></i> Members of {{ $period->title }}</span>
                        <span class="badge badge-light">
                            {{ $period->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <strong>Years:</strong>
                                {{ $period->start_year ?? '...' }} - {{ $period->end_year ?? '...' }}
                            </div>
                            <div class="mt-2 mt-md-0">
                                <a href="{{ route('Admin.past-committee-members.create', $period) }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Add Member
                                </a>
                                <a href="{{ route('Admin.past-committee-periods.edit', $period) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Edit Period
                                </a>
                                <a href="{{ route('Admin.past-committee-periods.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($period->members as $member)
                                        <tr>
                                            <td>{{ $member->id }}</td>
                                            <td>{{ $member->serial }}</td>
                                            <td>
                                                @if($member->image)
                                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" height="50" width="50" style="object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->designation }}</td>
                                            <td>
                                                <a href="{{ route('Admin.past-committee-members.edit', [$period, $member]) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('Admin.past-committee-members.destroy', [$period, $member]) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No members added to this period yet</td>
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
