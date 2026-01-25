<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Attendance;

class StudentProfile extends Controller
{
    public function addwork(){
        return view('backend.studentprofile.addwork');
    }

    public function storework(Request $request){

        date_default_timezone_set('Asia/Dhaka');
        $date = date("d/m/Y");
        $date_time = date("d/m/Y h:i:s a");

        $user_id = Auth::guard('admin')->user()->id;
        $student_id = Auth::guard('admin')->user()->student_id;
     if($photo = $request->file('image')){

        $photo = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('/backend/studentworkimage/'), $photo);

        $data['work'] = 'public/backend/studentworkimage/'.$photo;
    }
    if($photovideo = $request->file('video')){

        $photovideo = time().'.'.request()->video->getClientOriginalExtension();
        request()->video->move(public_path('/backend/studentworkvideo/'), $photovideo);

        $data['video'] = 'public/backend/studentworkvideo/'.$photovideo;
    }

    if($photozip = $request->file('zipfile')){

        $photozip = time().'.'.request()->zipfile->getClientOriginalExtension();
        request()->zipfile->move(public_path('/backend/studentworkzipfile/'), $photozip);

        $data['zipfile'] = 'public/backend/studentworkzipfile/'.$photozip;
    }

    $data['user_id'] = $user_id;
    $data['date'] = $date;
    $data['date_time'] = $date_time;
    $data['class_no'] = $request->class_no;
    $data['student_id'] = $student_id;
     DB::table('studentworks')->insert($data);

     $flashdata = ['class'=>'success', 'message'=>"Data Insert Successfull "];
     return redirect()->back()->with($flashdata);

    }

    public function allworkstudent(){
        $data['stuwork'] = DB::table('studentworks')->where('user_id',Auth::guard('admin')->user()->id)->get();
        return view('backend.studentprofile.studnetwork',$data);
    }

    public function studentprofile(){
        $user_id = Auth::guard('admin')->user()->id;
        $data['userData'] = DB::table('admins')->where('id',$user_id)->first();
        return view('backend.studentprofile.studentprofile',$data);
    }


    public function studentreport(){
        $stu_id = Auth::guard('admin')->user()->student_id;
        $student_data = $data['student'] = DB::table('students')->where('student_id',$stu_id)->first();
       $forpay  = DB::table('payments')->where('student_id',$stu_id)->sum('amount');
       $course = DB::table('courses')->where('id',$student_data->course_id)->first();
      $total_fee =($course->course_fee * $course->discount)/100;
      $data['payment_history'] = $total_fee - $forpay;

      $data['ck']= Attendance::get()->unique('date')->where('course_id',$student_data->course_id)->count();

      $data['present'] = DB::table('attendances')->where('course_id',$student_data->course_id)->where('student_id',$stu_id)->where('attendance',1)->count();
      $data['absent'] = DB::table('attendances')->where('course_id',$student_data->course_id)->where('student_id',$stu_id)->where('attendance',0)->count();

        return view('backend.studentprofile.studentreport',$data);
    }
}
