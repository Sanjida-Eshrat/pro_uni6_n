<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shift;
use DB;

class ShiftController extends Controller
{
       public function view()
    {
    	$data['allData']=Shift::all();
	    return view('backend.setup.shift.view-shift',$data);
    	//dd('ok');
    }

    public function add()
    {
	    return view('backend.setup.shift.add-shift');
    	
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:shifts,name',
    	]);

    	$data = new Shift();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.shift.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Shift::find($id);
    	return view('backend.setup.shift.add-shift',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Shift::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:shifts,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.shift.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = Shift::find($request->id);

        $data->delete();
        return redirect()->route('setups.shift.view')->with('success','Data deleted successfully!');

    }
}
