<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use DB;
use PDF;
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;
use App\Model\LeavePurpose;
use App\Model\EmployeeLeave;

class EmployeeLeaveController extends Controller
{
    public function view()
    {
        $data['allData']=EmployeeLeave::orderBy('id','desc')->get();
        return view('backend.employee.employee_leave.view-leave',$data);
    }

    public function add()
    {
    	$data['employees']=User::where('usertype','employee')->get();
        $data['leave_purpose']=LeavePurpose::all();
        return view('backend.employee.employee_leave.add-leave',$data);
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
          
           $employee_leave = new EmployeeLeave();
           $employee_leave->employee_id = $request->employee_id;
           $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
           $employee_leave->end_date = date('Y-m-d',strtotime($request->start_date));
           $employee_leave->leave_purpose_id = $leave_purpose_id;
           $employee_leave->save();

        return redirect()->route('employees.leave.view')->with('success','Data inserted successfully.');
    }

    public function edit($id){
    	$data['editData'] = EmployeeLeave::find($id);
    	$data['employees'] = User::where('usertype','employee')->get();
    	$data['leave_purpose']=LeavePurpose::all();
    	return view('backend.employee.employee_leave.add-leave',$data);
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
          
           $employee_leave = EmployeeLeave::find($id);
           $employee_leave->employee_id = $request->employee_id;
           $employee_leave->start_date = date('Y-m-d',strtotime($request->start_date));
           $employee_leave->end_date = date('Y-m-d',strtotime($request->start_date));
           $employee_leave->leave_purpose_id = $leave_purpose_id;
           $employee_leave->save();

        return redirect()->route('employees.leave.view')->with('success','Data updated successfully.');	 
    }

}
