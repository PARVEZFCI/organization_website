@extends('backend.admin-layout')
@section('title', 'Edit Membership Fee - Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="col-md-6 offset-md-3">
            <div class="card bg-white">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-edit"></i> Edit {{ $fee->name }} Fee
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.membership_fees.update', $fee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="fee">Fee Amount</label>
                            <input type="number" step="0.01" class="form-control @error('fee') is-invalid @enderror" id="fee" name="fee" value="{{ $fee->fee }}" required>
                            @error('fee')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('Admin.membership_fees.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
