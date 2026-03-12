@extends('backend.admin-layout')
@section('title', 'Constitution')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex align-items-center">
                        <h2 class="mb-0"><i class="fa fa-file-alt"></i><span style="margin-left: 10px;">Constitution</span></h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.bylaws.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title">Constitution Title</label>
                                    <input type="text" name="title" id="title" class="form-control" 
                                           value="{{ $bylaw->title ?? 'BESWA Constitution' }}" placeholder="Enter title">
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="file_type">File Type</label>
                                    <select name="file_type" id="file_type" class="form-control" onchange="toggleFileType()">
                                        <option value="">Select Type</option>
                                        <option value="pdf" {{ (isset($bylaw) && $bylaw->file_type == 'pdf') ? 'selected' : '' }}>PDF</option>
                                        <option value="image" {{ (isset($bylaw) && $bylaw->file_type == 'image') ? 'selected' : '' }}>Image</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="file">Upload File (PDF or Image)</label>
                                    <input type="file" name="file" id="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                    @if(isset($bylaw) && $bylaw->file_path)
                                        <small class="text-success">
                                            <i class="fa fa-check-circle"></i> Current file: 
                                            <a href="{{ asset($bylaw->file_path) }}" target="_blank">{{ basename($bylaw->file_path) }}</a>
                                        </small>
                                    @endif
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="content">Constitution Content (Optional - for display)</label>
                                    <textarea name="content" id="content"
                                        class="form-control ckeditor">{{ $bylaw->content ?? '' }}</textarea>
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
        if(typeof CKEDITOR !== 'undefined' && !CKEDITOR.instances['content']) {
            CKEDITOR.replace('content');
        }
        
        function toggleFileType() {
            // Optional: Add logic if needed
        }
    </script>
@endsection
