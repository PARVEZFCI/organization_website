@extends('backend.admin-layout')
@section('title', 'Event Registrations - ')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-users"></i> Registrations for {{ $event->title }}
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <strong>{{ $registrations->count() }}</strong> registrations
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.upcoming_events.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Back to Events
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Source</th>
                                            <th>Batch</th>
                                            <th>Phone</th>
                                            <th>Participants</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($registrations as $registration)
                                            <tr>
                                                <td>{{ $registration->registration_code }}</td>
                                                <td>
                                                    <strong>{{ $registration->full_name }}</strong>
                                                    @if($registration->email)
                                                        <div class="small text-muted">{{ $registration->email }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $registration->attendee_source === 'member' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($registration->attendee_source) }}
                                                    </span>
                                                    @if($registration->membership_type_snapshot)
                                                        <div class="small text-muted">{{ $registration->membership_type_snapshot }}</div>
                                                    @endif
                                                </td>
                                                <td>{{ $registration->batch_number ?? 'N/A' }}</td>
                                                <td>{{ $registration->phone ?? 'N/A' }}</td>
                                                <td>{{ $registration->participantSummary() ?: 'N/A' }}</td>
                                                <td>{{ number_format((float) $registration->total_amount, 2) }}</td>
                                                <td>{{ ucfirst($registration->payment_status) }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $registration->registration_status)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No registrations yet.</td>
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
