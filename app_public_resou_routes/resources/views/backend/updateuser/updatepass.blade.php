@extends('backend.admin-layout')
@section('title', 'Dashboard - Update Password ')
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
                <i class="fa fa-user-circle"></i><span>Update your password</span>
            </div>

            <div class="card">
            <div class="card-header bg-white">

              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i>&nbsp; Update Password
              </div> 

              <div style="display:inline-block;float: right; padding-top:5px;">
               
                

       
              </div> 

            </div>
            <div class="card-body">


            <form action="{{url('admin/updatepass')}}" id="qcat" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <br>
                <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> Current Password </label>
                          <input required="" type="text" class="form-control"  name="current_pass" placeholder="Current Password">
                      </div>
                  </div>

                  <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> New Password </label>
                          <input required="" type="text" class="form-control"  name="newpass" placeholder="New Password">
                      </div>
                  </div>

                  <div class="col-md-6">
                <br>
                      <div class="form-group">
                          <label for="name"> Confirm Password</label>
                          <input required="" type="text" class="form-control"  name="confirmpass" placeholder="Confirm Password">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    
  </script>


  @endsection
 