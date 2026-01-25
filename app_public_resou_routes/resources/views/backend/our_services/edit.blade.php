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
                        <i class="fa fa-cogs"></i>
                        Edit Service
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Edit Service
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.our_services.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('Admin.our_services.update', $service->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $service->title) }}" placeholder="Enter service title" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_title" class="form-label">Sub Title</label>
                                            <input type="text" name="sub_title" class="form-control"
                                                value="{{ old('sub_title', $service->sub_title) }}" placeholder="Enter sub title">
                                            @error('sub_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="icon" class="form-label">Icon Class Name</label><br>
                                            @if($service && $service->icon)
                                                <div class="mb-2">
                                                    <i class="{{ $service->icon }}" style="font-size: 40px;"></i>
                                                    <span class="ml-2 text-muted">({{ $service->icon }})</span>
                                                </div>
                                            @endif
                                            <input type="text" name="icon" class="form-control" 
                                                value="{{ old('icon', $service->icon) }}" 
                                                placeholder="e.g., fa fa-check, bi bi-star">
                                            <small class="form-text text-muted">Enter icon class name (e.g., fa fa-check, bi bi-star, flaticon-class)</small>
                                            @error('icon')
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
                                        <a href="{{ route('Admin.our_services.index') }}" class="btn btn-danger btn-block">
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
