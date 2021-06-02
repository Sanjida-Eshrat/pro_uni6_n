<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\ExamTypes;
use DB;

class ExamTypeController extends Controller
{
     public function view()
    {
    	$data['allData']=ExamTypes::all();
	    return view('backend.setup.exam_type.view-exam-type',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.exam_type.add-exam-type');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:exam_types,name',
    	]);

    	$data = new ExamTypes();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.exam.type.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = ExamTypes::find($id);
    	return view('backend.setup.exam_type.add-exam-type',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = ExamTypes::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:exam_types,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.exam.type.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = ExamTypes::find($request->id);

        $data->delete();
        return redirect()->route('setups.exam.type.view')->with('success','Data deleted successfully!');

    }
}
