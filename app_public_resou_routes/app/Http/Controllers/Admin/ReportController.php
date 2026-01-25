<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function dailystatementdate(){
        return view('backend.report.dailystatementdate');
    }

    public function dailystatement(Request $request){

        $day_before =$data['dailyDate']= $request->date;
        $data['newdate'] = $date = date("Y-m-d", strtotime($day_before));

        $data['data'] = DB::table('earnings')
        ->join('earningnames','earnings.earning_name_id','earningnames.id')
        ->select('earnings.*','earningnames.earning_name')
        ->where('earnings.date',$date)->get();

        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();

        return view('backend.report.dailyearnstatement',$data);

    }

    public function monthlystatementdate(){

       
        return view('backend.report.monthlystatementdate');
    }

    public function monthlystatement(Request $request){

        $f_date = $request->f_date;
        $data['newdate'] = $ff_date = date("d-m-Y", strtotime($f_date));

        $t_date =$data['dailyDate']= $request->t_date;
        $data['newdate'] = $tt_date = date("d-m-Y", strtotime($t_date));

        $data['data'] = DB::table('earnings')
        ->join('earningnames','earnings.earning_name_id','earningnames.id')
        ->select('earnings.*','earningnames.earning_name')
        ->whereBetween('earnings.date', [$f_date, $t_date])->get();
        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();
      
        return view('backend.report.monthlyearnstatement',$data);
    }

    public function totalcostearn(){
        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();
        $data['earn']=DB::table('earnings')
        ->join('earningnames','earnings.earning_name_id','earningnames.id')
        ->select('earnings.*','earningnames.earning_name')
        ->orderBy('earnings.id','DESC')->get();
        $data['expenses']=DB::table('expenses')
        ->join('expensenames','expenses.expense_name','expensenames.id')
        ->select('expenses.*','expensenames.expensename')
        ->orderBy('id','DESC')->get();
        return view('backend.report.totalearn',$data);
    }

    public function earningnamewise(){
        $data['earningname'] = DB::table('earningnames')->orderBy('id','DESC')->get();
        return view('backend.report.earningnamewise',$data);
    }

    public function earningnamewisestatement(Request $request){
         
        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();
        $f_date = $request->f_date;
        $data['newdate'] = $ff_date = date("d-m-Y", strtotime($f_date));
        $t_date =$data['dailyDate']= $request->t_date;
        $data['newdate'] = $tt_date = date("d-m-Y", strtotime($t_date));
        
        $data['earningname'] = DB::table('earningnames')->where('id',$request->earning_name)->first();

        $data['data'] = DB::table('earnings')
        ->join('earningnames','earnings.earning_name_id','earningnames.id')
        ->where('earnings.earning_name_id',$request->earning_name)
        ->whereBetween('earnings.date',[$f_date,$t_date])->select('earningnames.earning_name','earnings.*')->get();
        
        return view('backend.report.earningnamewisestatement',$data);
    }
    public function profitedaterange(){

        return view('backend.report.profitedaterange');
    }

    public function profitedaterangestatement(Request $request){

        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();
        $f_date = $request->f_date;
        $data['newdate'] = $ff_date = date("d-m-Y", strtotime($f_date));
        $t_date =$data['dailyDate']= $request->t_date;
        $data['newdate'] = $tt_date = date("d-m-Y", strtotime($t_date));

        $data['settings'] = DB::table('settings')->orderBy('id','DESC')->first();

        $data['earn']=DB::table('earnings')
        ->join('earningnames','earnings.earning_name_id','earningnames.id')
        ->select('earnings.*','earningnames.earning_name')
        ->whereBetween('earnings.date',[$f_date,$t_date])
        ->orderBy('earnings.id','DESC')->get();

    

        $data['expenses']=DB::table('expenses')
        ->join('expensenames','expenses.expense_name','expensenames.id')
        ->select('expenses.*','expensenames.expensename')
        ->whereBetween('expenses.date',[$f_date,$t_date])
        ->orderBy('id','DESC')->get();

 
        return view('backend.report.profitedaterangestatement',$data);


    }

    public function datewiseexpanse(){
        return view('backend.report.datewiseexpanse',$data);
    }

    
}
