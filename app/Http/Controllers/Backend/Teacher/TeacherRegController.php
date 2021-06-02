<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
//use App\Model\AssignTeacher;
use App\Model\Department; 
use DB;
use PDF;
use App\Model\TeacherSalaryLog;
//use App\Model\TeacherDesignation;
use App\Model\Designation;


class TeacherRegController extends Controller
{
    public function view()
    {
        $data['allData']=User::where('usertype','teacher')->get();
        return view('backend.teacher.teacher_reg.view-teacher',$data);
    }

    public function add()
    {
        $data['designations']=Designation::all();
        return view('backend.teacher.teacher_reg.add-teacher',$data);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            $teacher = User::where('usertype','teacher')->orderBy('id','DESC')->first();
            if($teacher == null){
                $firstReg = 0;
                $teacherId = $firstReg+1;
                if($teacherId < 10){
                    $id_no = '000'.$teacherId;
                }
                elseif($teacherId < 100){
                    $id_no = '00'.$teacherId;
                }
                elseif($teacherId < 100){
                    $id_no = '0'.$teacherId;
                }
            }
            else{
               $teacher = User::where('usertype','teacher')->orderBy('id','DESC')->first()->id;
               $teacherId = $teacher+1;
               if($teacherId < 10){
                    $id_no = '000'.$teacherId;
                }
                elseif($teacherId < 100){
                    $id_no = '00'.$teacherId;
                }
                elseif($teacherId < 100){
                    $id_no = '0'.$teacherId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'teacher';
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
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/teacher_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $teacher_salary = new TeacherSalaryLog();
            $teacher_salary->teacher_id = $user->id;
            $teacher_salary->effected_date =date('Y-m-d',strtotime($request->join_date));
			$teacher_salary->previous_salary = $request->salary;            
            $teacher_salary->present_salary = $request->salary;
            $teacher_salary->increment_salary = '0';
            $teacher_salary->save();  
        });

        return redirect()->route('teachers.reg.view')->with('success','Data inserted successfully.');
    }

    public function edit($id)
    {
        $data['editData']=User::find($id);
         $data['designations']=Designation::all();
        return view('backend.teacher.teacher_reg.add-teacher',$data);
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
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/teacher_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/teacher_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();   
        return redirect()->route('teachers.reg.view')->with('success','Data updated successfully.');
    }


   /* public function details($id)
    { 
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.teacher.teacher_reg.teacher-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }   */    
    public function details_n($id)
    {
       $data['details'] = User::find($id);
        return view('backend.teacher.teacher_reg.teacher-details',$data);
    }
}
