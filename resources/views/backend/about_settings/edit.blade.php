@extends('backend.admin-layout')
@section('title', 'Edit About Page')
@section('content')
@php
    $setting = $setting ?? new \App\Models\AboutSetting();
@endphp
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
                        <form action="{{ route('Admin.about_settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- director_message field removed per specification -->
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

                                <div class="col-md-12 mt-4 mb-3">
                                    <h4 class="text-info"><i class="fas fa-university"></i> Campus Section (Home Page)</h4>
                                    <hr>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="campus_title">Campus Title</label>
                                    <input type="text" name="campus_title" id="campus_title" class="form-control" 
                                        value="{{ $setting->campus_title ?? '' }}" placeholder="e.g., Bangladesh Institute of Management & Technology (BIMT)">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="campus_description">Campus Description</label>
                                    <textarea name="campus_description" id="campus_description" class="form-control" rows="4" 
                                        placeholder="Brief description about the campus">{{ $setting->campus_description ?? '' }}</textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="campus_image">Campus Image</label>
                                    <input type="file" name="campus_image" id="campus_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: 800x600px or similar ratio</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    @if(isset($setting->campus_image) && $setting->campus_image)
                                    <label>Current Campus Image</label><br>
                                    <img src="{{ asset($setting->campus_image) }}" alt="Campus" class="img-thumbnail" style="max-height: 150px;">
                                    @endif
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
        if (typeof CKEDITOR !== 'undefined') {
            if (!CKEDITOR.instances['who_we_are']) {
                CKEDITOR.replace('who_we_are');
            }
            if (!CKEDITOR.instances['mission_vission']) {
                CKEDITOR.replace('mission_vission');
            }
        }
    </script>
@endsection