@extends('backend.admin-layout')
@section('title', 'Blog List')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            <a href="{{ route('Admin.blogs.create') }}" class="btn btn-primary">Add New Blog</a>
        </div>
        <div class="card bg-white">
            <div class="card-header border-0 text-white bg-info">
                <i class="fa fa-list"></i>
                <h2>Blog List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" width="80" />
                                @endif
                            </td>
                            <td>{{ $blog->status ? 'Published' : 'Draft' }}</td>
                            <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('Admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('Admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
