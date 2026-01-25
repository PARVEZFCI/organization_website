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
                        <i class="fa fa-user-circle"></i>
                        Edit Home Settings
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Edit Home Settings
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                {{-- Optional actions --}}
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('Admin.home_settings.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="banner_image" class="form-label">Banner Image</label><br>
                                            @if($setting && $setting->banner_image)
                                                <img height="50" width="50" src="/{{ $setting->banner_image }}" alt="Banner" style="max-width:300px;"
                                                    class="mb-2"><br>
                                            @endif
                                            <input type="file" name="banner_image" class="form-control">
                                        </div>
                                    </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $setting->title ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="details" class="form-label">Details</label>
                                        <input type="text" name="details" class="form-control"
                                            value="{{ $setting->details ?? '' }}">
                                    </div>
                                </div>                                    <div class="col-md-6 mt-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-check-square-o"></i> Save
                                        </button>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <a href="{{ url('admin/allcategory') }}" class="btn btn-danger btn-block">
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