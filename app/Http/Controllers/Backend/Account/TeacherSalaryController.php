<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\TeacherSalaryLog;
use App\Model\TeacherAttendance;
use App\Model\AccountTeacherSalary;

class TeacherSalaryController extends Controller
{
   public function view()
   {
        $data['allData'] = AccountTeacherSalary::all();
         return view('backend.account.teacher.salary-view',$data);
   }

    public function add()
    {
        return view('backend.account.teacher.salary-add');
    }

    public function getTeacher(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));
        if($date !=''){
            $where[] = ['date','like',$date.'%'];
        }
        $data = TeacherAttendance::select('teacher_id')->groupBy('teacher_id')->with(['user'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Teacher Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Select</th>';
        foreach($data as $key => $attend) {
            $account_salary = AccountTeacherSalary::where('teacher_id',$attend->teacher_id)->where('date',$date)->first();
            if($account_salary !=null){
                $checked= 'checked';
            }
            else{
                $checked= '';
            }

            $totalattend = TeacherAttendance::with(['user'])->where('teacher_id',$attend->teacher_id)->get();
            $absentcount = count($totalattend->where('attend_status','Absent'));
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            $salary =(float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday;
            $totalsalary = (float)$salary-(float)$totalsalaryminus;
            $html[$key]['tdsource'] .= '<td>'.$totalsalary.'<input type="hidden" name="amount[]" value="'.$totalsalary.'"'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="teacher_id[]" value="'.$attend->teacher_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.'style="transform: scale(1.5);margin-left:10px;">'.'</td>';       
        }
        return response()->json(@$html);
    }

    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountTeacherSalary::where('date',$date)->delete();
        $checkdata = $request->checkmanage;
        if($checkdata !=null){
            for($i=0; $i <count($checkdata); $i++){
                $data = new AccountTeacherSalary();
                $data->date = $date;
                $data->teacher_id = $request->teacher_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        if(!empty(@$data) || empty($checkdata)){
           return redirect()->route('accounts.teacher.salary.view')->with('success', 'Well done! successfully updated');
        }
        else{
           return redirect()->back()->with('error', 'Sorry! Data not saved.');
        }
    }
}
