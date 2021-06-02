<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\TeacherDesignation;
use DB;

class TeacherDesignationController extends Controller
{
    public function view()
    {
    	$data['allData']=TeacherDesignation::all();
	    return view('backend.setup.teacherDesignation.view-teacher-desig',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.teacherDesignation.add-teacher-desig');
    }

    public function store(Request $request)
    {
       /* $this->validate($request,[
    		'name'=>'required|unique:teacher_designations,name',
    	]);*/

    	$data = new TeacherDesignation();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.teacher.designation.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = TeacherDesignation::find($id);
    	return view('backend.setup.teacherDesignation.add-teacher-desig',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = TeacherDesignation::find($id);
       /* $this->validate($request,[
    		'name'=>'required|unique:teacher_designations,name'
    	]);*/
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.teacher.designation.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = TeacherDesignation::find($request->id);

        $data->delete();
        return redirect()->route('setups.teacher.designation.view')->with('success','Data deleted successfully!');

    }
}
