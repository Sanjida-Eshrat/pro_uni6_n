<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Semester;
use App\Model\Subject;
use DB;

class SubjectController extends Controller
{
     public function view()
    {
    	$data['allData']=Subject::all();
	    return view('backend.setup.subject.view-subject',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.subject.add-subject');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:subjects,name',
    	]);

    	$data = new Subject();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.subject.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Subject::find($id);
    	return view('backend.setup.subject.add-subject',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Subject::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:subjects,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.subject.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = Subject::find($request->id);

        $data->delete();
        return redirect()->route('setups.subject.view')->with('success','Data deleted successfully!');

    }
}
