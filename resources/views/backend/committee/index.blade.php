@extends('backend.admin-layout')
@section('title', 'Committee Members - Dashboard')
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
                        Committee Members
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                All Committee Members
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.committee.create') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> Add New Member
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Position Order</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($committees as $committee)
                                            <tr>
                                                <td>{{ $committee->id }}</td>
                                                <td>{{ $committee->position_order }}</td>
                                                <td>
                                                    @if($committee->image)
                                                        <img src="{{ asset('storage/' . $committee->image) }}" alt="{{ $committee->name }}" height="50" width="50" style="object-fit: cover; border-radius: 50%;">
                                                    @else
                                                        <span class="text-muted">No image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $committee->name }}</td>
                                                <td>{{ $committee->position }}</td>
                                                <td>{{ $committee->email ?? 'N/A' }}</td>
                                                <td>{{ $committee->phone ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('Admin.committee.edit', $committee->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('Admin.committee.destroy', $committee->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No committee members found</td>
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
