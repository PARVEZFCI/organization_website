@extends('backend.admin-layout')
@section('title', 'Events - ')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-calendar"></i> Upcoming Events
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-table"></i> All Events
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.upcoming_events.create') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> Add New Event
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Banner</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Venue</th>
                                            <th>Registrations</th>
                                            <th>Registration</th>
                                            <th>Pinned</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($events as $event)
                                            <tr>
                                                <td style="width: 120px;">
                                                    @if($event->banner_path)
                                                        <img src="{{ asset($event->banner_path) }}" alt="{{ $event->title }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 6px;">
                                                    @else
                                                        <span class="text-muted">No banner</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $event->title }}</strong>
                                                    @if($event->sub_title)
                                                        <div class="text-muted small">{{ $event->sub_title }}</div>
                                                    @endif
                                                </td>
                                                <td>{{ $event->date->format('M d, Y') }}</td>
                                                <td>{{ $event->venue ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('Admin.upcoming_events.registrations', $event) }}" class="btn btn-sm btn-outline-primary">
                                                        {{ $event->registrations_count }} view
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($event->registrationIsOpen())
                                                        <span class="badge badge-success">Open</span>
                                                    @else
                                                        <span class="badge badge-secondary">Closed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($event->is_pinned)
                                                        <span class="badge badge-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    <a href="{{ route('Admin.upcoming_events.edit', $event) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('Admin.upcoming_events.togglePin', $event->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm {{ $event->is_pinned ? 'btn-secondary' : 'btn-info' }}">
                                                            {{ $event->is_pinned ? 'Unpin' : 'Pin' }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('Admin.upcoming_events.destroy', $event) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No events found.</td>
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
