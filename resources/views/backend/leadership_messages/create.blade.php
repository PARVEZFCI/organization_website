@extends('backend.admin-layout')
@section('title', 'Add Leadership Message')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-10 offset-md-1">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex align-items-center justify-content-between">
                        <span><i class="fa fa-plus-circle"></i> Add Leadership Message</span>
                        <a href="{{ route('Admin.leadership_messages.index') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('Admin.leadership_messages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="designation">Designation <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation') }}" placeholder="e.g. President, General Secretary" required>
                                        @error('designation')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="display_order">Display Order <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" required>
                                        <small class="text-muted">Lower number = appears first</small>
                                        @error('display_order')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                        <small class="text-muted">Recommended: 400x400px or larger</small>
                                        @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="message">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Save Message
                                </button>
                                <a href="{{ route('Admin.leadership_messages.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
