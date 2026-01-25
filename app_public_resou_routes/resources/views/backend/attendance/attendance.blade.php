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
                <i class="fa fa-user-circle"></i><span> Attendance Sheet</span>
            </div>
            
          <div class="card">
            <div class="card-header">

              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i>&nbsp; Attendance Sheet
              </div> 
              
              <h3 class="text-center">{{$course->course_name}}</h3>
              <h5 class="text-center">Total Complite Class ({{$ck}})</h5>

              <div style="display:inline-block;float: right; padding-top:5px;">
               
                <!-- <a href="" class="btn btn-dark">+add new</a> -->

       
              </div> 

             

            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered text-center">
              <thead>
                    <tr>
                        <th width="">SN</th>
                        <th>Student Name  </th>
                        <th>Total Present  </th>
                        <th>Total Absent</th>
                        <th>Due Balance</th>
                        <th>Next Payment Date</th>
                        <th>Payment</th>
                        <th width="" class="text-center">Action</th>
                    </tr>
                </thead>
                <form method="post" action="{{url('admin/storeattendance')}}">
                @csrf
                <tbody>
                	@php $i=1;
               
             @endphp
               @foreach($student as $row)
              @php
               $present = DB::table('attendances')->where('course_id',$row->course_id)
               ->where('student_id',$row->student_id)->where('attendance',1)->count();

               $absent = DB::table('attendances')->where('course_id',$row->course_id)
               ->where('student_id',$row->student_id)->where('attendance',0)->count();
               @endphp
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$present}}</td>
                        <td>{{$absent}}</td>
                        <td>
                          @if($row->due<=0)
                          <span style="color:green;font-size:20px">
                           Paid</span>
                           @else
                           <span style="color:red">
                           {{$row->due}}</span>
                          
                          @endif
                        </td>
                        @if($row->due<=0)
                        
                        @else 
                        <td>{{$row->next_payment_date}}</td>
                        

                        <td> <a href="{{url('admin/studentfee')}}">Payment Now</a> </td>
                        @endif 
                         <td > 
                           <input type="hidden" name="id[]" value="{{$row->student_id}}">
                           <input type="hidden" name="course_id" value="{{$row->course_id}}">
                           <input name='attendance[]' type="checkbox" id="checkItem" value="1">&nbsp; present 
                           <input name='attendance[]' type="checkbox" id="checkItem" value="0">&nbsp; Absent 
                          </td>
                    </tr>

                    
                   
                   
                @endforeach
                <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                         <td > 
                           <button type="submit" class="btn btn-sm btn-info">submit</button>
                          </td>
                    </tr>
                </tbody>
                </form>
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
 