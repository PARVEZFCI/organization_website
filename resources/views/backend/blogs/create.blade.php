@extends('backend.admin-layout')
@section('title', 'Add Blog')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="card bg-white">
            <div class="card-header border-0 text-white bg-info">
                <i class="fa fa-plus"></i>
                <h2>Add Blog</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('Admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Excerpt</label>
                        <textarea name="excerpt" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="form-control" id="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Published</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('content');</script>
@endsection
