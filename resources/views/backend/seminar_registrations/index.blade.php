@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
@section('content')
@php

@endphp
<!-- <a href="{{route('Admin.home')}}">Home</a> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- /.content-header -->
    <!-- Main content -->


      <div class="container-fluid">

        <!-- <div class="col-md-2"></div> -->
<br>
        <div class="col-md-12">

        <div class="card bg-white">

      		<div class="card-header border-0  text-white bg-info" >
                <i class="fa fa-user-circle"></i><span> All Registration</span>
            </div>

            <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <br>
              <table id="example" class="table table-bordered text-center">
              <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Seminar Title</th>
                        <th>Registered At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                    <tr>
                        <td>{{$registration->id}}</td>
                        <td>{{$registration->name}}</td>
                        <td>{{$registration->email}}</td>
                        <td>{{$registration->phone}}</td>
                        <td>{{$registration->address}}</td>
                        <td>{{$registration->seminar_title}}</td>
                        <td>{{$registration->created_at}}</td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            </div>
            </div>
          </div>

          </div>

        </div>




      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> -->


  <script type="text/javascript">

    //   $(document).ready( function (){
    //     $('#example').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'print'
    //     ]
    // });
    //   });

    $(document).ready(function(){
      $("#example").DataTable();
    })

    </script>


  @endsection
