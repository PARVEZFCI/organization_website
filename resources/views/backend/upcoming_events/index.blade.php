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
                        <i class="fa fa-calendar"></i>
                        Upcoming Events
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                All Events
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> Add New Event
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Sub Title</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($events as $event)
                                            <tr>
                                                <td>{{ $event->id }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ $event->sub_title ?? 'N/A' }}</td>
                                                <td>{{ $event->date->format('M d, Y') }}</td>
                                                <td>{!! Str::limit($event->details, 50) ?? 'N/A' !!}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#editModal{{ $event->id }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('Admin.upcoming_events.destroy', $event->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Edit Event</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('Admin.upcoming_events.update', $event->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="title">Title <span class="text-danger">*</span></label>
                                                                            <input type="text" name="title" class="form-control"
                                                                                value="{{ $event->title }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="sub_title">Sub Title</label>
                                                                            <input type="text" name="sub_title" class="form-control"
                                                                                value="{{ $event->sub_title }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="date">Event Date <span class="text-danger">*</span></label>
                                                                            <input type="date" name="date" class="form-control"
                                                                                value="{{ $event->date->format('Y-m-d') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="details">Details</label>
                                                                            <textarea name="details" id="details_edit_{{ $event->id }}" class="form-control" rows="3">{{ $event->details }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fa fa-save"></i> Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No events found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content-wrapper -->

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Create New Event</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('Admin.upcoming_events.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Enter event title" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_title">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control"
                                        placeholder="Enter sub title" value="{{ old('sub_title') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date">Event Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control"
                                        value="{{ old('date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" id="details_create" class="form-control" rows="3" 
                                        placeholder="Enter event details">{{ old('details') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor for create modal
    $('#createModal').on('shown.bs.modal', function () {
        if (!CKEDITOR.instances['details_create']) {
            CKEDITOR.replace('details_create');
        }
    });

    // Initialize CKEditor for edit modals
    @foreach($events as $event)
        $('#editModal{{ $event->id }}').on('shown.bs.modal', function () {
            if (!CKEDITOR.instances['details_edit_{{ $event->id }}']) {
                CKEDITOR.replace('details_edit_{{ $event->id }}');
            }
        });
    @endforeach

    // Destroy CKEditor instances when modals are closed
    $('.modal').on('hidden.bs.modal', function () {
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].destroy();
        }
    });
</script>
@endsection
