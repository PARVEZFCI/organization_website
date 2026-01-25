<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB; 

class adminRegistrationController extends Controller
{
    public function register(){
    	return view('backend.registration');
    }
    public function ragisterloginaction(Request $request){
    	$data=array();

    	$data['name'] = $request->name;
    	$data['email'] = $request->email;
    	$data['address'] = $request->address;

    	if ($request->password == $request->c_password) {
    		
    		$data['password'] = Hash::make($request->password);

    	}else{
    		$flashData = ['class'=>'danger','message'=>'password not match'];
    		return redirect()->back()->with($flashData);
    	}
    	$success = DB::table('admins')->insert($data);

    	if ($success) {

    		$flashData = ['class'=>'success','message'=>'successfully'];
    		return redirect()->back()->with($flashData);
    		
    	}else{
    		$flashData = ['class'=>'danger','message'=>'password not match'];
    		return redirect()->back()->with($flashData);
    	}
    }
}
