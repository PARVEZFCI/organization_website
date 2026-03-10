@extends('backend.admin-layout')
@section('title', 'Bylaws')
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
                        <h2 class="mb-0"><i class="fa fa-file-alt"></i><span style="margin-left: 10px;">Bylaws</span></h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.bylaws.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <label for="content">Bylaws Content</label>
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
        CKEDITOR.replace('content');
    </script>
@endsection
