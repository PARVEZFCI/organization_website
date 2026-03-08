@extends('backend.admin-layout')
@section('title', 'Membership Fees - Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        @if(session('success'))
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <div class="alert-icon contrast-alert"><i class="icon-check"></i></div>
                    <div class="alert-message"><span>{{ session('success') }}</span></div>
                </div>
            </div>
        @endif
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-money"></i> Membership Fee Settings
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Fee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $fee)
                                <tr>
                                    <td>{{ $fee->name }}</td>
                                    <td>{{ number_format($fee->fee,2) }}</td>
                                    <td>
                                        <a href="{{ route('Admin.membership_fees.edit', $fee->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
