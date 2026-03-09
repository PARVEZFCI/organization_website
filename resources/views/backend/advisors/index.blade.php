@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
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

            @if(session('message'))
                <div class="col-lg-12">
                    <div class="alert alert-{{ session('class') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                        <div class="alert-message"><span>{{ session('message') }}</span></div>
                    </div>
                </div>
            @endif

            <br>

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-user-tie"></i>
                        Advisory Council
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                All Advisors
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> Add New Advisor
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($advisors as $advisor)
                                            <tr>
                                                <td>{{ $advisor->id }}</td>
                                                <td>
                                                    @if($advisor->photo)
                                                        <img src="/{{ $advisor->photo }}" alt="Advisor" height="50" width="50" style="object-fit: cover; border-radius: 50%;">
                                                    @else
                                                        <span class="text-muted">No photo</span>
                                                    @endif
                                                </td>
                                                <td>{{ $advisor->name }}</td>
                                                <td>{{ $advisor->designation }}</td>
                                                <td>{{ $advisor->order }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $advisor->status ? 'success' : 'danger' }}">
                                                        {{ $advisor->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#editModal{{ $advisor->id }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('Admin.advisors.destroy', $advisor->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this advisor?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $advisor->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Edit Advisor</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('Admin.advisors.update', $advisor->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="name">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="name"
                                                                                value="{{ $advisor->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="designation">Designation <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="designation"
                                                                                value="{{ $advisor->designation }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="order">Order</label>
                                                                            <input type="number" class="form-control" name="order"
                                                                                value="{{ $advisor->order }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="status">Status</label>
                                                                            <div>
                                                                                <input type="checkbox" name="status" value="1"
                                                                                    {{ $advisor->status ? 'checked' : '' }}>
                                                                                <span>Active</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="description">Description</label>
                                                                            <textarea class="form-control" name="description" rows="3">{{ $advisor->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="photo">Photo</label>
                                                                            <input type="file" class="form-control" name="photo" accept="image/*">
                                                                            @if($advisor->photo)
                                                                                <img src="/{{ $advisor->photo }}" alt="Current photo" class="mt-2" height="100">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Advisor</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No advisors found</td>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add New Advisor</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('Admin.advisors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="designation" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" name="order" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div>
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span>Active</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create Advisor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
