@extends('backend.admin-layout')
@section('title', 'Why Choose List')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="mb-3">
                <a href="{{ route('Admin.why_chooses.create') }}" class="btn btn-primary">Add New Why Choose</a>
            </div>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <i class="fa fa-list"></i>
                    <h2>Why Choose List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($whyChooses as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>@if($item->image)<img src="/{{ $item->image }}" style="max-width:60px;">@endif</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('Admin.why_chooses.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('Admin.why_chooses.destroy', $item->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
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