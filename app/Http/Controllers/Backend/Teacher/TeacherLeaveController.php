<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Department; 
use DB;
use PDF;
use App\Model\TeacherSalaryLog;
use App\Model\Designation;
use App\Model\LeavePurpose;
use App\Model\TeacherLeave;
use App\Model\TeacherAttendance;
use Auth;

class TeacherLeaveController extends Controller
{
    public function view()
    {
        $data['allData']=TeacherLeave::orderBy('id','desc')->get();
        return view('backend.teacher.teacher_leave.view-leave',$data);
    }

    public function add()
    {
    	$data['teachers']=User::where('usertype','teacher')->get();
        $data['leave_purpose']=LeavePurpose::all();
        return view('backend.teacher.teacher_leave.add-leave',$data);
    }

    public function store(Request $request)
    {
           if($request->leave_purpose_id=="0"){
           		$leavepurpose = new LeavePurpose();
           		$leavepurpose->name = $request->name;
           		$leavepurpose->save();
           		$leave_purpose_id = $leavepurpose->id;
           }
           else{
           		$leave_purpose_id = $request->leave_purpose_id;
           }
          
           $teacher_leave = new TeacherLeave();
           $teacher_leave->teacher_id = $request->teacher_id;
           $teacher_leave->start_date = date('Y-m-d',strtotime($request->start_date));
           $teacher_leave->end_date = date('Y-m-d',strtotime($request->start_date));
           $teacher_leave->leave_purpose_id = $leave_purpose_id;
           $teacher_leave->save();

        return redirect()->route('teachers.leave.view')->with('success','Data inserted successfully.');
    }

    public function edit($id){
    	$data['editData'] = TeacherLeave::find($id);
    	$data['teachers'] = User::where('usertype','teacher')->get();
    	$data['leave_purpose']=LeavePurpose::all();
    	return view('backend.teacher.teacher_leave.add-leave',$data);
    }

    public function update(Request $request,$id){
           if($request->leave_purpose_id=="0"){
           		$leavepurpose = new LeavePurpose();
           		$leavepurpose->name = $request->name;
           		$leavepurpose->save();
           		$leave_purpose_id = $leavepurpose->id;
           }
           else{
           		$leave_purpose_id = $request->leave_purpose_id;
           }
          
           $teacher_leave = TeacherLeave::find($id);
           $teacher_leave->teacher_id = $request->teacher_id;
           $teacher_leave->start_date = date('Y-m-d',strtotime($request->start_date));
           $teacher_leave->end_date = date('Y-m-d',strtotime($request->start_date));
           $teacher_leave->leave_purpose_id = $leave_purpose_id;
           $teacher_leave->save();

        return redirect()->route('teachers.leave.view')->with('success','Data updated successfully.');	 
    }
}
