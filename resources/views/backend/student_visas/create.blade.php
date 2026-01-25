@extends('backend.admin-layout')
@section('title', 'Add Student Visa')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <h2>Add Student Visa</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.student_visas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Student Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection