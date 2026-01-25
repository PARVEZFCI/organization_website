@extends('backend.admin-layout')
@section('title', 'Student Reviews')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <a href="{{ route('Admin.student_reviews.create') }}" class="btn btn-primary mb-3">Add Review</a>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <h2>Student Reviews</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Course Name</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ $review->course_name }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>
                                        <a href="{{ route('Admin.student_reviews.edit', $review->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('Admin.student_reviews.destroy', $review->id) }}" method="POST"
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