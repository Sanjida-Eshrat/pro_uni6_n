<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Designation;
use App\User;
use DB;

class DesignationController extends Controller
{
     public function view()
    {
    	$data['allData']=Designation::all();
	    return view('backend.setup.designation.view-desig',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.designation.add-desig');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:designations,name',
    	]);

    	$data = new Designation();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.designation.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Designation::find($id);
    	return view('backend.setup.designation.add-desig',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Designation::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:designations,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.designation.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = Designation::find($request->id);

        $data->delete();
        return redirect()->route('setups.designation.view')->with('success','Data deleted successfully!');

    }
}
