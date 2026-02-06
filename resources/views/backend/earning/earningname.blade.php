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
                <i class="fa fa-user-circle"></i><span> All Expense name</span>
            </div>

            <div class="card">
            <div class="card-header">

              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i>&nbsp; All Expense name
              </div>

              <div style="display:inline-block;float: right; padding-top:5px;">

                <a href="{{url('admin/earningnameadd')}}" class="btn btn-dark">+add new</a>


              </div>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <br>
              <table id="dataTable" class="table table-bordered text-left">
              <thead>
                    <tr>
                        <th width="">SN</th>
                        <th>Earning Name</th>

                        <th width="" class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                	@php $i=1;

             @endphp
               @foreach($expensename as $row)


                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->earning_name}}</td>



                         <td >

                          <a href="{{url('admin/deletewithdraw/'.$row->id)}}" class="btn btn-danger"> <i class="fa fa-trash"></i> </a>
                          <a href="{{url('admin/editWithdraw/'.$row->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>


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




      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">

  </script>


  @endsection
