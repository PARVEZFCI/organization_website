<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Student;
use App\Models\Admin\Admin;
use App\Models\Shiftbatch;
use DB;
use Auth;
use Hash;
//use App\models\  ;

class StudentController extends Controller
{
    public function allstudent()
    {

        $data['student'] = $student = DB::table('students')
            ->join('courses', 'students.batch_id', 'courses.id')
            ->select('students.*', 'courses.course_name', 'courses.course_fee', 'courses.discount')->get();

        return view('backend.student.allstudent', $data);

    }

    public function addstudent()
    {
        $data['earnname'] = DB::table('earningnames')->orderBy('id', 'DESC')->get();
        $data['course'] = Category::all();
        return view('backend.student.addstudent', $data);
    }

    public function course_details(Request $request)
    {

        $course_details = DB::table('courses')->where('id', $request->course_id)->first();
        return json_encode($course_details);

    }

    public function cat_details(Request $request)
    {

        $course_name = DB::table('courses')->where('category_id', $request->cat_id)->where('status', 1)->get();
        // $html = '';
        // $html.='

        // <div class="form-group">
        //                   <select name="course_id" class="form-control">
        //                     <option value="0">Select Course</option>
        //                   ';
        //                   foreach($course_name as $row){
        //                      $html.= '<option value="'.$row->id.'">'.$row->course_name.'</option>';
        //                   }
        //               $html.=' </select>
        //               </div>';
        // return $html;

        return json_encode($course_name);

    }

    public function storestudent(Request $request)
    {

        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");
        $date_time = date("Y/m/d h:i:s a");

        $branch_id = Auth::guard('admin')->user()->id;

        if ($photo = $request->file('image')) {
            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $photo = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('/backend/student_image/'), $photo);

            $data['image'] = 'public/backend/student_image/' . $photo;
        }

        if ($nid = $request->file('nid')) {
            request()->validate([
                'nid' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $nid = time() . '.' . request()->nid->getClientOriginalExtension();
            request()->nid->move(public_path('/backend/student_nid/'), $nid);
            $data['nid'] = 'public/backend/student_nid/' . $nid;
        }

        if ($certificate = $request->file('certificate')) {
            request()->validate([
                'certificate' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $certificate = time() . '.' . request()->certificate->getClientOriginalExtension();
            request()->certificate->move(public_path('/backend/student_certificate/'), $certificate);
            $data['certificate'] = 'public/backend/student_certificate/' . $certificate;
        }

        $for_stu = DB::table('students')
            ->orderBy('id', 'desc')
            ->first();
        if (empty($for_stu)) {
            $billno = 0;
            $data['student_id'] = Auth::guard('admin')->user()->id + $billno + 1;
            $student_id = Auth::guard('admin')->user()->id + $billno + 1;
        } else {
            $data['student_id'] = Auth::guard('admin')->user()->id + $for_stu->id + 1;
            $student_id = Auth::guard('admin')->user()->id + $for_stu->id + 1;
        }


        $discount_fee = $request->discount_fee;

        $data['branch_id'] = $branch_id;
        $data['batch_id'] = $request->course_id;
        $data['date'] = $request->date;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['address'] = $request->address;
        $data['fathers_name'] = $request->fathers_name;
        $data['fathers_number'] = $request->fathers_number;
        $data['mothers_name'] = $request->mothers_name;
        $data['course_id'] = $request->course_id;
        $data['education'] = $request->education;
        $data['session'] = $request->session;
        $data['b_group'] = $request->b_group;
        $data['special_discount'] = $request->special_discount;
        $data['fee'] = $discount_fee;
        $data['due'] = $discount_fee - ($request->payment + $request->special_discount);
        $data['next_payment_date'] = $request->next_payment_date;
        $data['reference'] = $request->reference ?? null;


        DB::table('students')->insert($data);
        $inputData = [
            'student_id' => $student_id,
            'earning_name_id' => $request->earning_name,
            'remarks' => 'Student payment',
            'amount' => $request->payment,
            'course_id' => $request->course_id,
            'date' => $date
        ];



        DB::table('earnings')->insert($inputData);


        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'student' => 1,
            'student_id' => $student_id
        ];

        DB::table('admins')->insert($userData);


        $flashdata = ['class' => 'success', 'message' => "Data Insert Successfull "];
        return redirect()->back()->with($flashdata);

    }




    public function studentfee()
    {
        $data['student_info'] = Student::all();
        $data['earningname'] = DB::table('earningnames')->orderBy('id', 'DESC')->get();
        return view('backend.student.studentfee', $data);
    }

    public function studetailsforfee(Request $request)
    {
        $data = DB::table('students')->where('student_id', $request->student_id)
            ->first();

        $html = '';
        $html .= '
            
        <h3> Student Name : ' . $data->name . '</h3>
        <h4> Student Email : ' . $data->email . ' </h4>
        <h4>Due Balance : ' . $data->due . '</h4>
        <h4>Next Payment Date : ' . $data->next_payment_date . ' </h4>

        ';

        return $html;

    }

    public function storestupayment(Request $request)
    {

        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");
        $date_time = date("d/m/Y h:i:s a");

        $student_table = DB::table('students')->where('student_id', $request->student_id)->first();

        $due = $student_table->due - $request->payment;

        $inputData = [
            'student_id' => $request->student_id,
            'course_id' => $student_table->batch_id,
            'earning_name' => $request->earning_name,
            'amount' => $request->payment,
            'date' => $date
        ];


        DB::table('earnings')->insert($inputData);

        if (isset($request->next_payment_date)) {

            $data['next_payment_date'] = $request->next_payment_date;


        }

        if ($due <= 0) {
            $data['due_status'] = 1;
        }
        $data['due'] = $due;



        DB::table('students')->where('student_id', $request->student_id)->update($data);

        $flashdata = ['class' => 'success', 'message' => "Data Insert Successfull "];
        return redirect()->back()->with($flashdata);

    }

    public function studenthomework()
    {
        $data['student'] = DB::table('students')->get();
        return view('backend.student.studenthomework', $data);
    }

    public function studentworkdetails(Request $request)
    {

        $data['student'] = DB::table('students')
            ->join('courses', 'students.course_id', 'courses.id')
            ->select('courses.course_name', 'students.*')
            ->where('student_id', $request->student_id)->first();

        $data['studectwork'] = DB::table('studentworks')
            ->join('students', 'studentworks.student_id', 'students.student_id')
            ->where('studentworks.student_id', $request->student_id)
            ->select('studentworks.*', 'students.name')->get();

        return view('backend.student.studentworkdetails', $data);


    }


    public function studetails($id)
    {

        $data['studetails'] = DB::table('students')->where('id', $id)->first();
        return view('backend.student.studetails', $data);
    }

    public function studentid($id)
    {

        $data['studentinfo'] = DB::table('students')->where('id', $id)->first();
        // print_r($data['studentinfo']);
        return view('backend.student.studentidcard', $data);

    }



    public function todaydue()
    {

        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");

        $data['dueinfo'] = DB::table('students')
            ->join('courses', 'students.batch_id', 'courses.id')
            ->select('students.*', 'courses.*')
            ->where('students.next_payment_date', $date)->get();
        return view('backend.student.duedate', $data);
    }

    public function deactivestu($id)
    {
        $data = [
            'status' => 0
        ];

        DB::table('students')->where('id', $id)->update($data);

        return redirect()->back();
    }

    public function activestu($id)
    {
        $data = [
            'status' => 1
        ];

        DB::table('students')->where('id', $id)->update($data);

        return redirect()->back();
    }

    public function studentedit($id)
    {


        $data['earnname'] = DB::table('earningnames')->orderBy('id', 'DESC')->get();
        $data['course'] = Category::all();
        $data['Shiftbatch'] = Shiftbatch::get()->where('status', 0);

        $data['studentedt'] = Student::where('id', $id)->first();


        return view('backend.student.editstudent', $data);
    }

    public function updatestudent(Request $request)
    {

        // $data['name'] = $request->name;
        // $data['email'] = $request->email;
        // $data['number'] = $request->number;
        // $data['address'] = $request->address;
        // $data['fathers_name'] = $request->fathers_name;
        // $data['fathers_number'] = $request->fathers_number;
        // $data['mothers_name'] = $request->mothers_name;
        // $data['education'] = $request->education;
        // $data['session'] = $request->session;
        // $data['b_group'] = $request->b_group;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'fathers_name' => $request->fathers_name,
            'mothers_name' => $request->mothers_name,
            'education' => $request->education,
            'session' => $request->session,
            'b_group' => $request->b_group,
            'shift_batch_id' => $request->shift_batch_id,
            'reference' => $request->reference ?? null,

        ];

        $update = DB::table('students')->where('id', $request->id)->update($data);


        if ($update) {
            $flashdata = ['class' => 'success', 'message' => "Data Update Successfull "];
            return redirect()->back()->with($flashdata);

        } else {
            return redirect()->back();
        }


    }

    public function studentform($id)
    {

        $data['settings'] = DB::table('settings')->orderBy('id', 'DESC')->first();

        $data['studentform'] = DB::table('students')->where('id', $id)->first();

        return view('backend.student.studentform', $data);
    }

    public function destroy($id)
    {
        // Find student
        $student = DB::table('students')->where('id', $id)->first();
        if (!$student) {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Student not found.']);
        }
        // Delete all dependent data
        DB::table('studentworks')->where('student_id', $student->student_id)->delete();
        DB::table('earnings')->where('student_id', $student->student_id)->delete();
        DB::table('attendances')->where('student_id', $student->student_id)->delete();
        DB::table('admins')->where('student_id', $student->student_id)->delete();
        // Delete student
        DB::table('students')->where('id', $id)->delete();
        return redirect()->back()->with(['class' => 'success', 'message' => 'Student and all related data deleted successfully.']);
    }

}
