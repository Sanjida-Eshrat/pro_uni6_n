<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use App\Model\FeeCategory; 
use App\Model\FeeCategoryAmount;
use App\Model\AccountStudentFee;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use DB;
use PDF;

class StudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountStudentFee::all();
        return view('backend.account.student.fee-view',$data);
    }

    public function add()
    { 
        $data['sessions']=Session::orderBy('id','DESC')->get();
        $data['departments']=Department::all();
        $data['fee_categories']=FeeCategory::all();
        return view('backend.account.student.fee-add',$data);
    }

    public function getStudent(Request $request)
    {
      $session_id =$request->session_id;
      $department_id=$request->department_id;
      $fee_category_id=$request->fee_category_id;
      $date=date('Y-m',strtotime($request->date));
      $data = AssignStudent::with(['discount'])->where('session_id',$session_id)->where('department_id',$department_id)->get();
      $html['thsource'] = '<th>ID No</th>';
      $html['thsource'] .= '<th>Student Name</th>';
      $html['thsource'] .= '<th>Father Name</th>';
      $html['thsource'] .= '<th>Original Fee</th>';
      $html['thsource'] .= '<th>Discount Amount</th>';
      $html['thsource'] .= '<th>Fee (This Student)</th>';
      $html['thsource'] .= '<th>Select</th>';
      foreach ($data as $key => $std){
        $student_fee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('department_id',$std->department_id)->first();
        $accountstudentfees = AccountStudentFee::where('student_id',$std->student_id)->where('session_id',$std->session_id)->where('department_id',$std->department_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
        if($accountstudentfees !=null){
          $checked= 'checked';
        }
        else{
          $checked= '';
        }
        $color = 'succcess';
      //  $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
        $html[$key]['tdsource'] = '<td>'.$std['student']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$std['student']['name'].'<input type="hidden" name="session_id" value="'.$std->session_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$std['student']['fname'].'<input type="hidden" name="department_id" value="'.$std->department_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$student_fee->amount.'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';
        $originalfee = $student_fee->amount;
        $discount = $std['discount']['discount'];
        $discountablefee = $discount/100*$originalfee;
        $finalfee = (int)$originalfee-(int)$discountablefee;
        $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-contyrol" readonly>'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.'style="transform: scale(1.5);margin-left:10px;">'.'</td>';
      }
      return response()->json(@$html);
    } 

    public function store(Request $request)
    {
      $date = date('Y-m', strtotime($request->date));
      AccountStudentFee::where('session_id',$request->session_id)->where('department_id',$request->department_id)->where('fee_category_id',$request->fee_category_id)->where('date',$date)->delete();
      $checkdata = $request->checkmanage;
      if($checkdata !=null){
        for($i=0; $i < count($checkdata); $i++){
           $data = new AccountStudentFee();
           $data->session_id = $request->session_id;
           $data->department_id = $request->department_id;
           $data->date = $date;
           $data->fee_category_id = $request->fee_category_id;
           $data->student_id = $request->student_id[$checkdata[$i]];
           $data->amount = $request->amount[$checkdata[$i]];
           $data->save();
        }
      }
      if(!empty(@$data) || empty($checkdata)){
        return redirect()->route('accounts.fee.view')->with('success', 'Well done! successfully updated');
      }
      else{
        return redirect()->back()->with('error', 'Sorry! Data not saved.');
      }
    
    }

}
