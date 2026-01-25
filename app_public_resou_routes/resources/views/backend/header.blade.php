<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- start linking  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
 

  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/app.css')}}">

  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  @php 
         $data = DB::table('settings')->orderBy('id','DESC')->first();
       
    @endphp
  <!-- icon -->
  <link rel="icon" href="{{url($data->logo)}}">
  <!-- end linking -->
    <title>@yield('title')</title>
</head>
<body>
<!-- start admin -->
<section id="admin">
  <!-- start sidebar -->
  @include('backend.slide')
  <!-- end sidebar -->
  <!-- start content -->
  <div class="content">
    <!-- start content head -->
    <div class="head">
      <!-- head top -->
      <div class="top">
        <div class="left">
          <button id="on" class="btn btn-info"><i class="fa fa-bars"></i></button>
          <button id="off" class="btn btn-info hide"><i class="fa fa-align-left"></i></button>
          <button class="btn btn-info hidden-xs-down"><i class="fa fa-expand-arrows-alt"></i></button>
          <button class="btn btn-info hidden-xs-down"><i class="fa fa-home"></i>Back Home</button>
        </div>
        <div class="right">
          <button class="btn btn-info hidden-xs-down"><i class="fa fa-bell"></i></button>
          <button class="btn btn-info hidden-xs-down"><i class="fa fa-envelope"></i></button>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::guard('admin')->user()->name}}</button>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
              @if(Auth::guard('admin')->user()->admin == 1)
             <a class="dropdown-item" href="{{url('admin/updateadmininfo')}}">profile</a>
             @elseif(Auth::guard('admin')->user()->employee == 1)
             <a class="dropdown-item" href="{{url('admin/updateemployee')}}">profile</a>
             @else
             <a class="dropdown-item" href="{{url('admin/updateadmininfo')}}">profile</a>
             @endif
             <a class="dropdown-item" href="{{url('admin/changepassword')}}">Change Password</a>
             <a class="dropdown-item" href="#">sitting</a>
             <a class="dropdown-item" href="{{url('admin/adminlogout')}}">log out</a>
           </div>
          </div>
        </div>
      </div>
      <!-- end head top -->
      <!-- start head bottom -->
      <!-- <div class="bottom">
        <div class="left">
          <h1>dashboard</h1>
        </div>
        <div class="right">
          <h1>dashboard /</h1>
          <a href="#">page name</a>
        </div>
      </div> -->
      <!-- end head bottom -->
    </div>