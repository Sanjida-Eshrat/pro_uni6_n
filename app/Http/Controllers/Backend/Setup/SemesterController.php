<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Semester;
use DB;

class SemesterController extends Controller
{
     public function view()
    {
    	$data['allData']=Semester::all();
	    return view('backend.setup.semester.view-sem',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.semester.add-sem');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:semesters,name',
    	]);

    	$data = new Semester();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.semester.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Semester::find($id);
    	return view('backend.setup.semester.add-sem',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Semester::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:semesters,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.semester.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = Semester::find($request->id);

        $data->delete();
        return redirect()->route('setups.semester.view')->with('success','Data deleted successfully!');

    }
}
