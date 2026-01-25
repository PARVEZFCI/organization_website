<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;

class UserController extends Controller
{

	public function userregistration(){
		return view('frontend.auth.userregistrationform');
	}
	public function storeUser(Request $request){
		print_r($request->all());
		$data=array();

    	$data['name'] = $request->name;
    	$data['email'] = $request->email;
    	$data['address'] = $request->address;
    	$data['username'] = $request->username;
    	$data['number'] = $request->number;

    	if ($request->password == $request->c_password) {
    		
    		$data['password'] = Hash::make($request->password);

    	}else{
    		$flashData = ['class'=>'danger','message'=>'password not match'];
    		return redirect()->back()->with($flashData);
    	}
    	$success = DB::table('users')->insert($data);

    	if ($success) {

    		$flashData = ['class'=>'success','message'=>'successfully'];
    		return redirect()->back()->with($flashData);
    		
    	}else{
    		$flashData = ['class'=>'danger','message'=>'password not match'];
    		return redirect()->back()->with($flashData);
    	}
	}
    
    public function loginuser(){
    	return view('frontend.auth.userlogin');
    }

    public function userlogin(Request $request){
	

    	if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {        	

        	$notification=array(
	            'messege'=>'Login Success!',
	            'alert-type'=>'success'
	             );
         
            return redirect()->intended(route('userdeshboard'))->with($notification);
        }else{
        	$notification=array(
	            'messege'=>'Email or Password wrong!',
	            'alert-type'=>'success'
	             );

        	return back()->with($notification);
        }
    }

	public function userdeshboard(){
		return view('frontend.userdeshboard');
	}

	public function userlogout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('/');
    }
}
