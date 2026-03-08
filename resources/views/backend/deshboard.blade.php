@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
@section('content')


@php
$date = date("Y-m-d");
$data =  Auth::guard('admin')->user();
$student = DB::table('students')->where('date',$date)->count();
@endphp
@if($data->admin==1)
<div id="real">
      <div class="row">
        @if(Auth::guard('admin')->user()->admin==1)
        <!-- start head content         -->
        <div class="col-lg-4 py-3">
            <form action="{{ route('Admin.generate.qr.code') }}" method="GET">
                <div class="form-group">
                    <label for="qr_data">Enter Data for QR Code</label>
                    <input type="text" name="qr_data" id="qr_data" class="form-control" placeholder="Enter text, URL, or any data" required>
                </div>
                <button type="submit" class="btn btn-sm btn-success mt-2">Generate QR Code</button>
                <br>
            </form>
        </div>
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4"></div>
        <br>
        @endif
        <div class="col-lg-4">
          <!-- avtive -->
          <div class="activeMode">
            <div class="card">
              <h1>Deactivate Mode</h1>
              <a href="" class="btn btn-info">Activate now</a>
            </div>
          </div>
          <!-- end active -->
          <!-- Regster Users -->
          <div class="regsterUsers">
            <div class="card">
              <div class="card-top">
                <h1>500</h1>
                <i class="fa fa-users"></i>
              </div>
              <div class="card-bottom">
                <p>New Registered Users This Month</p>
              </div>
            </div>
          </div>
          <!-- end  Regster Users-->
        </div>
        <div class="col-lg-8">
          <div id="money">
            <div class="card">
              <div id="chart" style="width:100%; height:270px;"></div>
            </div>
          </div>
        </div>
        <!-- end head content -->
        <!-- start analytics -->
        <div class="col-lg-3">
          <div class="analytics">
            <div class="card">
              <div class="icon"><i class="fa fa-video"></i></div>
              <div class="text">
                <h1>{{$student }}</h1>
                <p>Today Admission Student</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="analytics">
            <div class="card">
              <div class="icon"><i class="fab fa-vimeo-v"></i></div>
              <div class="text">
                <h1></h1>
                <p>Total Tv-Series</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="analytics">
            <div class="card">
              <div class="icon"><i class="fa fa-users"></i></div>
              <div class="text">
                <h1>32</h1>
                <p>Total users</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="analytics">
            <div class="card">
              <div class="icon"><i class="fa fa-envelope"></i></div>
              <div class="text">
                <h1>43</h1>
                <p>Total emails</p>
              </div>
            </div>
          </div>
        </div>
        <!-- end analytics -->
        <!-- start member list -->
        <div class="col-lg-12 mt-4">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Member List</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Course</th>
                      <th>Membership Type</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($memberships as $member)
                      <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->full_name }}</td>
                        <td>{{ $member->email ?? 'N/A' }}</td>
                        <td>{{ $member->mobile ?? 'N/A' }}</td>
                        <td>{{ $member->course_name ?? 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ $member->membership_type ?? 'N/A' }}</span></td>
                        <td>{{ $member->amount ?? 'N/A' }}</td>
                        <td>{{ $member->created_at->format('Y-m-d') }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8" class="text-center text-muted">No members found</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end member list -->
        <!-- start user -->


      </div>
    </div>

    @endif


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  @endsection
