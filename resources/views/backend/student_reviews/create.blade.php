@extends('backend.admin-layout')
@section('title', 'Add Student Review')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <h2>Add Student Review</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.student_reviews.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="course_name">Course Name</label>
                            <input type="text" name="course_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="">Select Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection