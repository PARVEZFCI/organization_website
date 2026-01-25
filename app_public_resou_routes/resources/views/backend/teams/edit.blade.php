@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
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
                        <i class="fa fa-users"></i>
                        Edit Team Member
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Edit Team Member
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.teams.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('Admin.teams.update', $team->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $team->name) }}" placeholder="Enter member name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="designation" class="form-label">Designation</label>
                                            <input type="text" name="designation" class="form-control"
                                                value="{{ old('designation', $team->designation) }}" placeholder="Enter designation">
                                            @error('designation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="slug" class="form-label">Slug (Optional)</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ old('slug', $team->slug) }}" placeholder="Leave empty to auto-generate from name">
                                            <small class="form-text text-muted">URL-friendly version (auto-generated from name if empty)</small>
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="details" class="form-label">Details</label>
                                            <textarea name="details" id="details" class="form-control" rows="4"
                                                placeholder="Enter member details">{{ old('details', $team->details) }}</textarea>
                                            @error('details')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Image</label><br>
                                            @if($team && $team->image)
                                                <img height="80" width="80" src="/{{ $team->image }}" alt="Team" style="max-width:300px; object-fit: cover;"
                                                    class="mb-2"><br>
                                            @endif
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-check-square-o"></i> Update
                                        </button>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <a href="{{ route('Admin.teams.index') }}" class="btn btn-danger btn-block">
                                            <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content-wrapper -->

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('details');
</script>
@endsection
