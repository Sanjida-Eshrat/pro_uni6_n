<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Department; 
use DB;
use PDF;
use App\Model\TeacherSalaryLog;
use App\Model\TeacherDesignation;

class TeacherSalaryController extends Controller
{
    public function view()
    {
        $data['allData']=User::where('usertype','teacher')->get();
        return view('backend.teacher.teacher_salary.view-teacher-salary',$data);
    }

    public function increment($id)
    {
        $data['editData']=User::find($id);
        return view('backend.teacher.teacher_salary.add-teacher-salary',$data);
    }

    public function store(Request $request,$id)
    {
    	$user = User::find($id);
    	$previous_salary = $user->salary;
    	$present_salary = (float)$previous_salary+(float)$request->increment_salary;
    	$user->salary = $present_salary;
    	$user->save();
    	$salaryData = new teacherSalaryLog();
    	$salaryData->teacher_id = $id;
    	$salaryData->previous_salary = $previous_salary;
    	$salaryData->increment_salary = $request->increment_salary;
    	$salaryData->present_salary = $present_salary;
    	$salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
    	$salaryData->save();
    	return redirect()->route('teachers.salary.view')->with('success','Salary incremented successfully!');
    }

    public function details($id)
    { 
        $data['details'] = User::find($id);
        $data['salary_log'] = TeacherSalaryLog::where('teacher_id',$data['details']->id)->get();
        return view('backend.teacher.teacher_salary.teacher-salary-details',$data);
    }   
}
