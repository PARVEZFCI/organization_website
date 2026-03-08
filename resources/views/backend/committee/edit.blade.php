@extends('backend.admin-layout')
@section('title', 'Edit Committee Member - Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-8 offset-md-2">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-edit"></i>
                        Edit Committee Member
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('Admin.committee.update', $committee->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="position_order" class="form-label">Position Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('position_order') is-invalid @enderror" id="position_order" name="position_order" value="{{ $committee->position_order }}" required>
                                @error('position_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $committee->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ $committee->position }}" required>
                                @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $committee->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $committee->phone }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ $committee->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if($committee->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $committee->image) }}" alt="{{ $committee->name }}" style="max-height: 150px; max-width: 150px; border-radius: 8px; object-fit: cover;">
                                        <p class="small text-muted mt-1">Current Image</p>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <small class="form-text text-muted">Accepted formats: jpeg, png, jpg, gif (Max: 2MB) - Leave empty to keep current image</small>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update Member
                                </button>
                                <a href="{{ route('Admin.committee.index') }}" class="btn btn-secondary">
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
