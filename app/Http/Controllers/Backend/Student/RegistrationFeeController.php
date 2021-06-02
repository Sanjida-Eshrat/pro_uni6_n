<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent; 
use App\User;
use App\Model\FeeCategoryAmount;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use DB;
use PDF;


class RegistrationFeeController extends Controller
{
    public function view()
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        return view('backend.student.registration_fee.view-registration-fee',$data);
        //dd('ok');
    }

    public function getStudent(Request $request)
    {
    	$session_id = $request->session_id;
    	$department_id = $request->department_id;
    	if($session_id != ''){
    		$where[] = ['session_id','like',$session_id.'%'];
    	}
    	if($department_id != ''){
    		$where[] = ['department_id','like',$department_id.'%'];
    	}
    	$allStudent = AssignStudent::with(['discount'])->where($where)->get();
    	$html['thsource'] = '<th>SL</th>';
    	$html['thsource'] .= '<th>ID No</th>';
    	$html['thsource'] .= '<th>Student Name</th>';
    	$html['thsource'] .= '<th>Roll No</th>';
    	$html['thsource'] .= '<th>Registration Fee</th>';
    	$html['thsource'] .= '<th>Discount Amount</th>';
    	$html['thsource'] .= '<th>Fee (This student)</th>';
    	$html['thsource'] .= '<th>Action</th>';

    	foreach($allStudent as $key => $v){
    		$registrationfee = FeeCategoryAmount::where('fee_category_id','1')->where('department_id',$v->department_id)->first();
    		$color = 'success';
    		$html[$key]['tdsource']='<td>'.($key+1).'</td>';
    		$html[$key]['tdsource'].='<td>'.$v['student']['id_no'].'</td>';
    		$html[$key]['tdsource'].='<td>'.$v['student']['name'].'</td>';
    		$html[$key]['tdsource'].='<td>'.$v->roll.'</td>';
    		$html[$key]['tdsource'].='<td>'.$registrationfee->amount.'TK'.'</td>';
    		$html[$key]['tdsource'].='<td>'.$v['discount']['discount'].'%'.'</td>';

    		$originalfee = $registrationfee->amount;
    		$discount = $v['discount']['discount'];
    		$discountablefee = $discount/100*$originalfee;
    		$finalfee = (float)$originalfee-(float)$discountablefee;

    		$html[$key]['tdsource'].='<td>'.$finalfee.'TK'.'</td>';
    		$html[$key]['tdsource'].='<td>';
    		$html[$key]['tdsource'].='<a class="btn btn-sm btn-'.$color.'"title="Payslip" target="_blank" href="'.route("students.reg.fee.payslip").'?department_id='.$v->department_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
    		$html[$key]['tdsource'].='<td>';

    	}
    	return response()->json(@$html);
    }
    public function paySlip(Request $request){
        $student_id = $request->student_id;
        $department_id = $request->department_id;
        $allStudent['details'] = AssignStudent::with(['discount','student'])->where('student_id',$student_id)->where('department_id',$department_id)->first();
        $pdf = PDF::loadView('backend.student.registration_fee.registration-fee-pdf',$allStudent);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
      
    }
}
