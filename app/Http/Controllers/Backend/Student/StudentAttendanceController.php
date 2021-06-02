<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent; 
use App\User;
use App\Model\FeeCategoryAmount;
use App\Model\StudentAttendance;
use App\Model\Department; 
use App\Model\Session;
use App\Model\ExamTypes;
use App\Model\Semester; 
use App\Model\Shift;
use DB;
use PDF;

class StudentAttendanceController extends Controller
{
  /*   public function view()
    {
        $data['allData']=StudentAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
       

        return view('backend.student.student_attend.view-attendance',$data);
    }
    public function searchStudent(Request $request)
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['session_id']=$request->session_id;
        $data['department_id']=$request->department_id;
         $data['semester_id']=$request->semester_id;
        $data['allData']=AssignStudent::where('session_id',$request->session_id)->where('department_id',$request->department_id)->where('semester_id',$request->semester_id)->get();
        return view('backend.student.student_attend.view-attendance',$data);
    }
    public function add()
    {
       $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
    	$data['students']=User::where('usertype','student')->get();
        return view('backend.student.student_attend.add-attendance',$data);
    }

     public function store(Request $request)
    {
	   StudentAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
       $countstudent = count($request->student_id);
       for($i=0; $i<$countstudent; $i++){
       		$attend_status = 'attend_status'.$i;
       		$attend = new StudentAttendance();
       		$attend->date = date('Y-m-d',strtotime($request->date));
       		$attend->student_id = $request->student_id[$i];
       		$attend->department_id = $request->department_id[$i];

       		$attend->attend_status = $request->$attend_status;
       		$attend->save();
       }    

      return redirect()->route('students.attendance.view')->with('success','Data inserted successfully.');
    }
     public function edit($date){
    	$data['editData'] = StudentAttendance::where('date',$date)->get();
    	$data['students']=User::where('usertype','student')->get();
        return view('backend.student.student_attend.add-attendance',$data);
      
    }

    public function details($date){
    	$data['details'] = StudentAttendance::where('date',$date)->get();
        return view('backend.student.student_attend.details-attendance',$data);
    } */

     public function view()
    {
        $data['allData'] =StudentAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
       

        return view('backend.student.student_attend.view-attendance',$data);
    }
    public function searchStudent(Request $request)
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['session_id']=$request->session_id;
        $data['department_id']=$request->department_id;
         $data['semester_id']=$request->semester_id;
        $data['allData']=AssignStudent::where('session_id',$request->session_id)->where('department_id',$request->department_id)->where('semester_id',$request->semester_id)->get();
        return view('backend.student.student_attend.view-attendance',$data);
    }
    public function add()
    {
       $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['students']=User::where('usertype','student')->get();
        return view('backend.student.student_attend.add-attendance',$data);
    }

     public function store(Request $request)
    {
     StudentAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
       $countstudent = count($request->student_id);
       for($i=0; $i<$countstudent; $i++){
          $attend_status = 'attend_status'.$i;
          $attend = new StudentAttendance();
          $attend->date = date('Y-m-d',strtotime($request->date));
          $attend->student_id = $request->student_id[$i];
          $attend->department_id = $request->department_id[$i];

          $attend->attend_status = $request->$attend_status;
          $attend->save();
       }    

      return redirect()->route('students.attendance.view')->with('success','Data inserted successfully.');
    }
     public function edit($date){
      $data['editData'] = StudentAttendance::where('date',$date)->get();
      $data['students']=User::where('usertype','student')->get();
        return view('backend.student.student_attend.add-attendance',$data);
      
    }

    public function details($date){
      $data['details'] = StudentAttendance::where('date',$date)->get();
        return view('backend.student.student_attend.details-attendance',$data);
    }
}
