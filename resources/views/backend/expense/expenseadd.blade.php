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
<br>
      <?php if (session('message')): ?>
        <div class="col-lg-12">
            <div class="alert alert-{{session('class')}} alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
              <div class="alert-message"><span>{{session('message')}}</span></div>
            </div>
        </div>
        <?php endif; ?>

        <!-- <div class="col-md-2"></div> -->
<br>
        <div class="col-md-12">

        <div class="card bg-white">

      		<div class="card-header border-0  text-white bg-info" >
                <i class="fa fa-user-circle"></i><span> Expense </span>
            </div>

            <div class="card">
            <div class="card-header bg-white">

              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i>&nbsp; Add Expense
              </div>

              <div style="display:inline-block;float: right; padding-top:5px;">




              </div>

            </div>
            <div class="card-body">


            <form action="{{url('admin/storeexpense')}}" id="qcat" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <br>
                <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> Expense Name </label>
                          <select class="form-control" name="expense_name" >
                            <option>Select Expense Name</option>
                            @foreach($expensename as $row)
                             <option value="{{$row->id}}">{{$row->expensename}}</option>
                            @endforeach

                          </select>
                      </div>
                  </div>

                  <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> Employee Name </label>
                          <select class="form-control" name="employee_id" >
                            <option>Select Employee</option>
                            @foreach($employee as $row)
                             <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach

                          </select>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <label>Batch Name</label>
                      <select name="course_id" class="form-control">
                      <option value="0">Select Option</option>
                      </select>
                  </div>

                  <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> Expense Name </label>
                          <input type="date" name="date" class="form-control">
                      </div>
                  </div>

                  <div class="col-md-6">

                      <div class="form-group">
                          <label for="name"> Expense Name </label>
                          <input type="text" name="amount" placeholder="Enter Expense Amount" class="form-control">
                      </div>
                  </div>

                  <div class="col-md-6">

                      <div class="form-group">
                          <label for="name"> Expense Remarks </label>
                          <input type="text" name="remarks" placeholder="Enter Remarks" class="form-control">
                      </div>
                  </div>

                  <div class="col-md-12">
                  </div>
                      <br>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-block col-md-offset-2">
                      <i class="fa fa-check-square-o"></i> Save
                    </button>
                  </div>

                  <div class="col-md-6">
                    <a href="{{url('admin/expense')}}" class="btn btn-danger btn-block col-md-offset-2">
                      <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back
                    </a>
                  </div>



              </div>

            </form>

            </div>
          </div>

          </div>

        </div>




      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">



$(document).ready(function(){
         $('select[name="employee_id"]').on('change',function(){
             var cat_id = $(this).val();

            if(cat_id) {
                $.ajax({
                    url:"{{url('admin/employee_data')}}",
                    data:{cat_id:cat_id},
                    type:"GET",
                    dataType:"json",

                    success:function(data){


                        var d =$('select[name="course_id"]').empty();
                        $('select[name="course_id"]').append('<option value="0">select option</option>');
                           $.each(data, function(key, value){
                               $('select[name="course_id"]').append('<option value="'+ value.id +'">' + value.course_name + '</option>');

                           });

                    }
                })
            }
         })
     })


  </script>


  @endsection
