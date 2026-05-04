@extends('backend.admin-layout')
@section('title', 'Add Past Committee Member - Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            <div class="col-md-8 offset-md-2">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-plus"></i>
                        Add Member to {{ $period->title }}
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

                        <form action="{{ route('Admin.past-committee-members.store', $period) }}" method="POST" enctype="multipart/form-data">
                            @include('backend.past_committee_members._form', ['submitLabel' => 'Save Member'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
