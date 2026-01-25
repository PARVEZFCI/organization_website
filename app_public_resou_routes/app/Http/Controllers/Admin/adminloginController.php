<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class adminloginController extends Controller
{
    public function login(){
    	
    	return view('backend.login');
    }

    public function admin_login_action(Request $request){

    	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {        	

        	$notification=array(
	            'messege'=>'Login Success!',
	            'alert-type'=>'success'
	             );
         
            return redirect()->intended(route('Admin.deshboard'))->with($notification);
        }else{
        	$notification=array(
	            'messege'=>'Email or Password wrong!',
	            'alert-type'=>'error'
	             );

        	return back()->with($notification);
        }
    }
}
