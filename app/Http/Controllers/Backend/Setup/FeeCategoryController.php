<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Session;
use App\Model\FeeCategory;
use DB;

class FeeCategoryController extends Controller
{
      public function view()
    {
    	$data['allData']=FeeCategory::all();
	    return view('backend.setup.fee_category.view-fee-category',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.setup.fee_category.add-fee-category');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:fee_categories,name',
    	]);

    	$data = new FeeCategory();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.fee.category.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = FeeCategory::find($id);
    	return view('backend.setup.fee_category.add-fee-category',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = FeeCategory::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:fee_categories,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('setups.fee.category.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = FeeCategory::find($request->id);

        $data->delete();
        return redirect()->route('setups.fee.category.view')->with('success','Data deleted successfully!');

    }
}
