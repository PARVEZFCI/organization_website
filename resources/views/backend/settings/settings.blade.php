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
                <i class="fa fa-user-circle"></i><span> Add Course</span>
            </div>

            <div class="card">
            <div class="card-header bg-white">

              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i>&nbsp; Add Course
              </div>

              <div style="display:inline-block;float: right; padding-top:5px;">

              </div>

            </div>
            <div class="card-body">


            <form action="{{url('admin/storesettings')}}" id="qcat" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <br>


                  <div class="col-md-6">

                      <div class="form-group">
                          <label for="name"> Company Name </label>
                          @if(isset($settings->company_name))
                           <input required="" type="text" class="form-control" value="{{$settings->company_name}}"  name="company_name" >
                          @else
                          <input required="" type="text" class="form-control"  name="company_name" >
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name"> Company Email </label>
                          @if(isset($settings->email))
                           <input required="" type="email" class="form-control" value="{{$settings->email}}"  name="email" >
                          @else
                          <input required="" type="email" class="form-control"  name="email" >
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Company Phone</label>
                          @if(isset($settings->phone))
                           <input required="" type="number" class="form-control" value="{{$settings->phone}}"  name="phone" >
                          @else
                          <input required="" type="number" class="form-control"  name="phone" >
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name"> Company Address </label>
                          @if(isset($settings->address))
                           <input required="" type="text" class="form-control" value="{{$settings->address}}"  name="address" >
                          @else
                          <input required="" type="text" class="form-control"   name="address" >
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name"> Company Logo </label>
                          @if(isset($settings->logo))
                           <input  type="file" class="form-control"   name="logo" >
                          @else
                          <input  type="file" class="form-control"   name="logo" >
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6"></div>
                  @if(isset($settings))
                  <div class="col-md-6">
                      <div class="form-group">
                          <img style="height:100px" src="{{url($settings->logo)}}">
                      </div>
                  </div>
                  @endif
                <div class="col-md-12">
                  </div>
                      <br>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-block col-md-offset-2">
                      <i class="fa fa-check-square-o"></i> Save
                    </button>
                  </div>

                  <div class="col-md-6">
                    <a href="{{url('admin/allcategory')}}" class="btn btn-danger btn-block col-md-offset-2">
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

  <script type="text/javascript">

  </script>


  @endsection
