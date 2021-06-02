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

class TeacherAttendanceController extends Controller
{
    public function view()
    {
        $data['allData']=TeacherAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('backend.teacher.teacher_attend.view-attendance',$data);
    }

    public function add()
    {
    	$data['teachers']=User::where('usertype','teacher')->get();
        return view('backend.teacher.teacher_attend.add-attendance',$data);
    }

    public function store(Request $request)
    {
	   TeacherAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
       $countteacher = count($request->teacher_id);
       for($i=0; $i<$countteacher; $i++){
       		$attend_status = 'attend_status'.$i;
       		$attend = new TeacherAttendance();
       		$attend->date = date('Y-m-d',strtotime($request->date));
       		$attend->teacher_id = $request->teacher_id[$i];
       		$attend->attend_status = $request->$attend_status;
       		$attend->save();
       }    

      return redirect()->route('teachers.attendance.view')->with('success','Data inserted successfully.');
    }

    public function edit($date){
    	$data['editData'] = TeacherAttendance::where('date',$date)->get();
    	$data['teachers']=User::where('usertype','teacher')->get();
        return view('backend.teacher.teacher_attend.add-attendance',$data);
    }

    public function details($date){
    	$data['details'] = TeacherAttendance::where('date',$date)->get();
        return view('backend.teacher.teacher_attend.details-attendance',$data);
    } 
}
