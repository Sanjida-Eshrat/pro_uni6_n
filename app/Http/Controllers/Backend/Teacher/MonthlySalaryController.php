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

class MonthlySalaryController extends Controller
{
     public function view()
    {
        return view('backend.teacher.monthly_salary.view-salary');
    }
    public function getSalary(Request $request){
    	$date = date('Y-m',strtotime($request->date));
    	if($date !=''){
    		$where[] = ['date','like',$date.'%'];
    	}
    	$data = TeacherAttendance::select('teacher_id')->groupBy('teacher_id')->with(['user'])->where($where)->get();
    	$html['thsource'] = '<th>SL</th>';
    	$html['thsource'] .= '<th>Teacher Name</th>';
    	$html['thsource'] .= '<th>Basic Salary</th>';
    	$html['thsource'] .= '<th>Salary (This month)</th>';
    	$html['thsource'] .= '<th>Action</th>';
    	foreach($data as $key => $attend){
    		$totalattend = TeacherAttendance::with(['user'])->where($where)->where('teacher_id',$attend->teacher_id)->get();
    		$absentcount = count($totalattend->where('attend_status','Absent'));
    		$color = 'success';
    		$html[$key]['tdsource']='<td>'.($key+1).'</td>';
    		$html[$key]['tdsource'].='<td>'.$attend['user']['name'].'</td>';
    		$html[$key]['tdsource'].='<td>'.$attend['user']['salary'].'</td>';
    		$salary=(float)$attend['user']['salary'];
    		$salaryperday=(float)$salary/30;
    		$totalsalaryminus=(float)$absentcount*(float)$salaryperday;
    		$totalsalary=(float)$salary-(float)$totalsalaryminus;
    		$html[$key]['tdsource'].='<td>'.$totalsalary.'</td>';
    		$html[$key]['tdsource'].='<td>';
    		$html[$key]['tdsource'].='<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("teachers.monthly.salary.payslip",$attend->teacher_id).'">Pay Slip</a>';
    		$html[$key]['tdsource'].='</td>';
    	}
    	return response()->json(@$html);

    } 
}
