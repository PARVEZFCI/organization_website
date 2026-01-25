<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expensename;
use App\Models\Expense;
use DB;

class ExpenseController extends Controller
{
    public function expensename(){
       $data['expensename'] = Expensename::all();
        return view('backend.expense.expensename',$data);

    }

    public function expensenameadd(){

        return view('backend.expense.expensenameadd');

    }
    
     public function expensenamestore(Request $request){

        $dataInput = [
            'expensename'=>$request->expensename
        ];
         
    Expensename::create($dataInput);

    $flashdata = ['class'=>'success', 'message'=>"Expense Name Insert Successfull "];
    return redirect()->back()->with($flashdata);


     }

     public function expense(){
        
         $data['Expense'] = DB::table('expenses')
         ->join('expensenames','expenses.expense_name','expensenames.id')
         ->select('expenses.*','expensenames.expensename')
         ->orderBy('id','DESC')->get();

        
         return view('backend.expense.expense',$data);
     }

     public function expenseadd(){
        $data['employee'] = DB::table('employees')->orderBy('id','DESC')->get();
         $data['expensename'] = Expensename::all();
         return view('backend.expense.expenseadd',$data);
     }

     public function storeexpense(Request $request){

        $inputData = [
            'expense_name' => $request->expense_name,
            'employee_id'=>$request->employee_id,
            'course_id'=>$request->course_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'date' => $request->date
        ];
        Expense::create($inputData);
         
        $employee = DB::table('employees')->where('id',$request->employee_id)->first();
      
        $updata = [
            'balance' => $employee->balance - $request->amount
        ];
         
        DB::table('employees')->where('id',$request->employee_id)->update($updata);

        $flashdata = ['class'=>'success', 'message'=>"Expense Insert Successfull "];
        return redirect()->back()->with($flashdata);
    

    }

}
