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

class EmployeeRegController extends Controller
{
    public function view()
    {
        $data['allData']=User::where('usertype','employee')->get();
        return view('backend.employee.employee_reg.view-employee',$data);
    }

    public function add()
    {
        $data['designations']=Designation::all();
        return view('backend.employee.employee_reg.add-employee',$data);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '0'.$employeeId;
                }
            }
            else{
               $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
               $employeeId = $employee+1;
               if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '0'.$employeeId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'employee';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->blood_group = $request->blood_group; 
            $user->salary = $request->salary; 
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date =date('Y-m-d',strtotime($request->join_date));
			$employee_salary->previous_salary = $request->salary;            
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();  
        });

        return redirect()->route('employees.reg.view')->with('success','Data inserted successfully.');
    }

    public function edit($id)
    {
        $data['editData']=User::find($id);
         $data['designations']=Designation::all();
        return view('backend.employee.employee_reg.add-employee',$data);
    }

    public function update(Request $request,$id)
    {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->blood_group = $request->blood_group;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/employee_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();   
        return redirect()->route('employees.reg.view')->with('success','Data updated successfully.');
    }


   /* public function details($id)
    { 
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }   */    
    public function details_n($id)
    {
       $data['details'] = User::find($id);
        return view('backend.employee.employee_reg.employee-details-n',$data);
    }
}
