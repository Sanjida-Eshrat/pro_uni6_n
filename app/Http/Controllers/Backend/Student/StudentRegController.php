<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent; 
use App\User;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use DB;
use PDF;

class StudentRegController extends Controller
{
    public function view()
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['session_id']=Session::orderBy('id','desc')->first()->id;
        $data['department_id']=Department::orderBy('id','asc')->first()->id;
        $data['semester_id']=Semester::orderBy('id','asc')->first()->id;
        $data['allData']=AssignStudent::where('session_id',$data['session_id'])->where('department_id',$data['department_id'])->where('semester_id',$data['semester_id'])->get();
        return view('backend.student.student_reg.view-student',$data);
        //dd('ok');
    }

    public function searchStudent(Request $request)
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['session_id']=$request->session_id;
        $data['department_id']=$request->department_id;
         $data['semester_id']=$request->semester_id;
        $data['allData']=AssignStudent::where('session_id',$request->session_id)->where('department_id',$request->department_id)->where('semester_id',$request->semester_id)->get();
        return view('backend.student.student_reg.view-student',$data);
    }

    public function add()
    {
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['shifts']=Shift::all();
      
        return view('backend.student.student_reg.add-student',$data);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $checkSession = Session::find($request->session_id)->name;
            $student = User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if($studentId < 10){
                    $id_no = '000'.$studentId;
                }
                elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }
                elseif($studentId < 100){
                    $id_no = '0'.$studentId;
                }
            }
            else{
               $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
               $studentId = $student+1;
               if($studentId < 10){
                    $id_no = '000'.$studentId;
                }
                elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }
                elseif($studentId < 100){
                    $id_no = '0'.$studentId;
                }
            }
            $final_id_no = $checkSession.$id_no;
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'student';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->blood_group = $request->blood_group;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->session_id = $request->session_id;
            $assign_student->department_id = $request->department_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->semester_id = $request->semester_id;
            $assign_student->gurdname = $request->gurdname;
            $assign_student->gurdphone = $request->gurdphone;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->fee_category_id = '1';
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->discount = $request->discount;
            $discount_student->save();
            
        });

        return redirect()->route('students.registration.view')->with('success','Data inserted successfully.');
    }

    public function edit($student_id)
    {
        $data['editData']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['shifts']=Shift::all();
      
        return view('backend.student.student_reg.add-student',$data);
    }

    public function update(Request $request,$student_id)
    {
         DB::transaction(function() use($request,$student_id){
        
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->blood_group = $request->blood_group;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('/upload/student_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();

            $assign_student->session_id = $request->session_id;
            $assign_student->department_id = $request->department_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->semester_id = $request->semester_id;
            $assign_student->gurdname = $request->gurdname;
            $assign_student->gurdphone = $request->gurdphone;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();

            $discount_student->discount = $request->discount;
            $discount_student->save();
            
        });

        return redirect()->route('students.registration.view')->with('success','Data updated successfully.');
    }

    public function promotion($student_id)
    {
        $data['editData']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $data['sessions']=Session::orderBy('id','desc')->get();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        $data['shifts']=Shift::all();
      
        return view('backend.student.student_reg.promotion-student',$data);
    }

     public function promotionStore(Request $request,$student_id)
    {
         DB::transaction(function() use($request,$student_id){
        
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->blood_group = $request->blood_group;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('/upload/student_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('/upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->session_id = $request->session_id;
            $assign_student->department_id = $request->department_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->semester_id = $request->semester_id;
            $assign_student->gurdname = $request->gurdname;
            $assign_student->gurdphone = $request->gurdphone;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id; 
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
            
        });

        return redirect()->route('students.registration.view')->with('success','Student promoted successfully.');
    }

  /*  public function details($student_id)
    { //dd('ok');
        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('backend.student.student_reg.student-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
       // return $pdf->download('document.pdf');
    } */

    public function details_n($student_id)
    {
       $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        return view('backend.student.student_reg.student-details-n',$data);
    }

}
