@extends('backend.admin-layout')
@section('title', 'Edit Blog')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="card bg-white">
            <div class="card-header border-0 text-white bg-info">
                <i class="fa fa-edit"></i>
                <h2>Edit Blog</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('Admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" width="100" />
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Excerpt</label>
                        <textarea name="excerpt" class="form-control">{{ $blog->excerpt }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="form-control" id="content">{{ $blog->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" @if($blog->status) selected @endif>Published</option>
                            <option value="0" @if(!$blog->status) selected @endif>Draft</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('content');</script>
@endsection
