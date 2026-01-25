<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Earningname;
use DB;

class EarningController extends Controller
{
    public function earningname(){
        $data['expensename'] = Earningname::all();
         return view('backend.earning.earningname',$data);
 
     }
 
     public function earningnameadd(){
 
         return view('backend.earning.earningnameadd');
 
     }
     
      public function earningnamestore(Request $request){
 
         $dataInput = [
             'earning_name'=>$request->earning_name
         ];
          
         Earningname::create($dataInput);
 
     $flashdata = ['class'=>'success', 'message'=>"Earning Name Insert Successfull "];
     return redirect()->back()->with($flashdata);
 
 
      }
 
      public function earning(){
          $data['earning'] = DB::table('earnings')->join('earningnames','earnings.earning_name_id','earningnames.id')->select('earnings.*','earningnames.earning_name')->orderBy('id','DESC')->get();
          
          return view('backend.earning.earning',$data);
      }
 
      public function earningadd(){
          $data['earningname'] = Earningname::all();
          return view('backend.earning.earningadd',$data);
      }
 
      public function storeearning(Request $request){
 
         $inputData = [
             'earning_name_id' => $request->earning_name,
             'amount' => $request->amount,
             'remarks' => $request->remarks,
             'date' => $request->date
         ];
         Earning::create($inputData);
         $flashdata = ['class'=>'success', 'message'=>"Earning Insert Successfull "];
         return redirect()->back()->with($flashdata);
     
 
     }

     public function moneyreceipt($id){

        $data['earnData'] = DB::table('earnings')
        ->join('students','earnings.student_id','students.student_id')
        ->select('earnings.*','students.name')
        ->where('earnings.id',$id)->first();

        return view('backend.earning.moneyreceipt',$data);
     }

    
}
