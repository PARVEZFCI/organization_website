@extends('backend.admin-layout')
@section('title', 'Add Country')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="card bg-white">
                <div class="card-header border-0 text-white bg-info">
                    <i class="fa fa-user-circle"></i>
                    <h2>Add Country</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.countries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Country Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Country Image</label>
                                <input type="file" name="image" class="form-control">
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
@endsection