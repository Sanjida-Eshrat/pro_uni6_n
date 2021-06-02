<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Semester;
use App\Model\Subject;
use App\Model\AssignSubject;
use DB;

class AssignSubjectController extends Controller
{
    public function view()
    {
        $data['allData']=AssignSubject::select('department_id')->groupBy('department_id')->get();
        return view('backend.setup.assign_subject.view-assign-subject',$data);
        //dd('ok');
    }

    public function add()
    {
        $data['subjects']=Subject::all();

        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        return view('backend.setup.assign_subject.add-assign-subject',$data);
    }

   public function store(Request $request)
    {
        $subCount = count($request->subject_id);
        if($subCount !=NULL){
            for($i=0; $i <$subCount; $i++){
                $assign_sub = new AssignSubject();
                $assign_sub->department_id = $request->department_id;
                $assign_sub->semester_id = $request->semester_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->get_mark = $request->get_mark[$i];
                $assign_sub->save();
            }
        }
        return redirect()->route('setups.assign.subject.view')->with('success','Data Inserted successfully.');
    }

    public function edit($department_id)
    {
        $data['editData'] = AssignSubject::where('department_id',$department_id)->get();
       // dd($data['editData']->toArray());
        $data['subjects']=Subject::all();
        $data['departments']=Department::all();
        $data['semesters']=Semester::all();
        return view('backend.setup.assign_subject.edit-assign-subject',$data);
    }

   public function update(Request $request,$department_id)
   {    
        if($request->subject_id==NULL){
            return redirect()->back()->with('error','Sorry! You did not select any item.');
        }
        else{
                AssignSubject::where('department_id',$department_id)->delete();
                $subCount = count($request->subject_id);
                for($i=0; $i <$subCount; $i++){
                $assign_sub = new AssignSubject();
                $assign_sub->department_id = $request->department_id;
                $assign_sub->semester_id = $request->semester_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->get_mark = $request->get_mark[$i];
                $assign_sub->save(); 
        }
        }
        
        return redirect()->route('setups.assign.subject.view')->with('success','Data updated successfully!');
    }

   // public function details

   /*  public function delete(Request $request)
    {
        //dd('ok');
        $data  = FeeCategoryAmount::find($request->id);

        $data->delete();
        return redirect()->route('setups.fee.category.view')->with('success','Data deleted successfully!');

    }*/
}
