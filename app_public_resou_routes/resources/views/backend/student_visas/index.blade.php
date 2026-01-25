@extends('backend.admin-layout')
@section('title', 'Student Visa List')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <a href="{{ route('Admin.student_visas.create') }}" class="btn btn-primary mb-3">Add Student Visa</a>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <h2>Student Visa List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td><img src="/{{ $student->image }}" style="max-width:100px;"></td>
                                    <td>
                                        <a href="{{ route('Admin.student_visas.edit', $student->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('Admin.student_visas.destroy', $student->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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