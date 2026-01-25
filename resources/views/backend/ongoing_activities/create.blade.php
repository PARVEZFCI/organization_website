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
                        <i class="fa fa-tasks"></i>
                        Create Activity
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Create New Activity
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.ongoing_activities.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('Admin.ongoing_activities.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title') }}" placeholder="Enter activity title" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_title" class="form-label">Sub Title</label>
                                            <input type="text" name="sub_title" class="form-control"
                                                value="{{ old('sub_title') }}" placeholder="Enter sub title">
                                            @error('sub_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="details" class="form-label">Details</label>
                                            <textarea name="details" id="details" class="form-control" rows="4"
                                                placeholder="Enter activity details">{{ old('details') }}</textarea>
                                            @error('details')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                                            <input type="file" name="thumbnail" class="form-control">
                                            @error('thumbnail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-check-square-o"></i> Save
                                        </button>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <a href="{{ route('Admin.ongoing_activities.index') }}" class="btn btn-danger btn-block">
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
