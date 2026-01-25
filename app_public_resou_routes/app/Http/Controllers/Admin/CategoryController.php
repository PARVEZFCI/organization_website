<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Auth;

class CategoryController extends Controller
{
    public function allcategory(){

        

    	$data['category'] = Category::all();

    	return view('backend.category.allcategory',$data);

    }

    public function addcategory(){
    	return view('backend.category.addcategory');
    }

    public function storecategory(Request $request){

    	$data = [
    		'category_name'=>$request->categories
    	];
        $insert =  Category::create($data);

        if ($insert) {

        	$flashdata = ['class'=>'success', 'message'=>"Data Insert Successfull "];

            return redirect()->back()->with($flashdata);
        	
        }

         

    }

    public function categorydlt($id){
        Category::find($id)->delete();
        $flashdata = ['class'=>'success', 'message'=>"category delete Successfull "];
            return redirect()->back()->with($flashdata);

    }

    public function editcategory($id){
        $data['category'] = DB::table('categories')->where('id',$id)->first(); 
        return \view('backend.category.editcategory',$data);
    }

    public function updatecategory(Request $request){

        $data = [
    		'category_name'=>$request->categories
    	];
        $update = DB::table('categories')->where('id',$request->id)->update($data);

        if ($update) {

        	$flashdata = ['class'=>'success', 'message'=>"Category Update Successfull "];

            return redirect()->back()->with($flashdata);
        	
        }

    }

    
}

