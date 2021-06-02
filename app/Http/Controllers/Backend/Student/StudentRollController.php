<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent; 
use App\User;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use DB;
use PDF;

class StudentRollController extends Controller
{
    public function view()
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        return view('backend.student.roll_generate.view-roll-generate',$data);
        //dd('ok');
    }

    public function getStudent(Request $request)
    {
    	$allData = AssignStudent::with(['student'])->where('department_id',$request->department_id)->where('session_id',$request->session_id)->where('semester_id',$request->semester_id)->get();
    	return response()->json($allData);
    }
    public function store(Request $request){
        $department_id = $request->department_id;
        $session_id = $request->session_id;
        $semester_id = $request->semester_id;
        if($request->student_id !=null){
            for($i=0; $i < count($request->student_id); $i++){
                AssignStudent::where('department_id',$request->department_id)->where('session_id',$request->session_id)->where('semester_id',$request->semester_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }  
        }else{
            return redirect()->back()->with('error','Sorry! There are no student.');
        }
         return redirect()->route('students.roll.view')->with('success','Successfully roll generated');
    }

}
