@extends('backend.admin-layout')
@section('title', 'Edit About Page')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-user-circle"></i>
                        <h2>Edit About Page</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.about_settings.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="director_message">Director Message</label>
                                    <textarea name="director_message" id="director_message"
                                        class="form-control ckeditor">{{ $setting->director_message ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="who_we_are">Who We Are</label>
                                    <textarea name="who_we_are" id="who_we_are"
                                        class="form-control ckeditor">{{ $setting->who_we_are ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="mission_vission">Mission & Vission</label>
                                    <textarea name="mission_vission" id="mission_vission"
                                        class="form-control ckeditor">{{ $setting->mission_vission ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-check-square-o"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('director_message');
        CKEDITOR.replace('who_we_are');
        CKEDITOR.replace('mission_vission');
    </script>
@endsection