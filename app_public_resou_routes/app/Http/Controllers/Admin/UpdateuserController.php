<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;

class UpdateuserController extends Controller
{
    public function changepassword(){
        
        return view('backend.updateuser.updatepass');
    }

    public function updatepass(Request $request){

        $request->validate([
            'current_pass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required'
        ]);

        
        $user_id =  Auth::guard('admin')->user()->id;

        if(!(Hash::check($request->get('current_pass'), Auth::guard('admin')->user()->password))) {
            // The passwords matches
            // return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            $flashdata = ['class'=>'danger', 'message'=>"Your current password does not matches with the password you provided. Please try again."];
            return redirect()->back()->with($flashdata);
        }
        if(strcmp($request->get('current_pass'), $request->get('newpass')) == 0){
            //Current password and new password are same
            // return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            $flashdata = ['class'=>'danger', 'message'=>"New Password cannot be same as your current password. Please choose a different password."];
            return redirect()->back()->with($flashdata);
        }
        if($request->get('newpass') != $request->get('confirmpass')){
            //Current password and new password are same
            // return redirect()->back()->with("error","New Password and Confirm New Password does not match.");
            $flashdata = ['class'=>'danger', 'message'=>"New Password and Confirm New Password does not match."];
            return redirect()->back()->with($flashdata);
        }
        
        //Change Password
        $user = Auth::guard('admin')->user();
        $user->password = bcrypt($request->get('newpass'));
        $user->save();
        $flashdata = ['class'=>'success', 'message'=>"Password changed successfully."];
        return redirect()->back()->with($flashdata);

    }
}
