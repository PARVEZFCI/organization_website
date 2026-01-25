@extends('backend.admin-layout')
@section('title', 'Edit Student Visa')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <h2>Edit Student Visa</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.student_visas.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">Student Image</label><br>
                            @if($student->image)
                                <img src="/{{ $student->image }}" style="max-width:100px;" class="mb-2"><br>
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection