<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use DB;

class DepartmentController extends Controller
{
    public function view()
    {
    	$data['allData']=Department::all();
	    return view('backend.setup.department.view-dept',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.department.add-dept');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:departments,name',
    	]);

    	$data = new Department();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.department.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Department::find($id);
    	return view('backend.setup.department.add-dept',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Department::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:departments,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.department.view')->with('success','Data updated successfully!');
    }

     public function delete($id )
    {
    	//dd('ok');
        $data  = Department::find($id);

        $data->delete();
        return redirect()->route('setups.department.view')->with('success','Data deleted successfully!');

    }
}
