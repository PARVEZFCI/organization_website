@extends('backend.admin-layout')
@section('title', 'Leadership Messages - Dashboard')
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

            <br>

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info d-flex align-items-center justify-content-between">
                        <span><i class="fa fa-comments"></i> Leadership Messages</span>
                        <a href="{{ route('Admin.leadership_messages.create') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-plus"></i> Add Message
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i>
                                Messages List
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($messages as $message)
                                            <tr>
                                                <td>{{ $message->display_order }}</td>
                                                <td>
                                                    @if($message->image)
                                                        <img src="{{ asset($message->image) }}" alt="{{ $message->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                    @else
                                                        <div style="width:60px;height:60px;background:#ddd;border-radius:8px;"></div>
                                                    @endif
                                                </td>
                                                <td>{{ $message->name }}</td>
                                                <td>{{ $message->designation }}</td>
                                                <td>{{ Str::limit($message->message, 80) }}</td>
                                                <td>
                                                    @if($message->status == 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('Admin.leadership_messages.edit', $message->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('Admin.leadership_messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No messages found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
