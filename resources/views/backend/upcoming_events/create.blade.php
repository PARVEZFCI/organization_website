@extends('backend.admin-layout')
@section('title', 'Create Event - ')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-calendar"></i> Create Event
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-plus"></i> New Event
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <a href="{{ route('Admin.upcoming_events.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> View All
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('Admin.upcoming_events.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('backend.upcoming_events._form', ['event' => new \App\Models\UpcomingEvent()])

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-check-square-o"></i> Save Event
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('Admin.upcoming_events.index') }}" class="btn btn-danger btn-block">
                                            <i class="fa fa-arrow-circle-o-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('details');
    </script>
@endsection
