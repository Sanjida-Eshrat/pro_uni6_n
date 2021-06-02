<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\WhyUs;

class WhyUsController extends Controller
{
    public function view()
    {	
    	$data['countWhyUs']=WhyUs::count();
    	$data['allData']=WhyUs::all();
    	return view('frontend.why-us.view-why-us',$data);
    }

    public function add()
    {
    	return view('frontend.why-us.add-why-us');
    }

    public function store(Request $request)
    {
    	$data = new WhyUs();
    	$data->title = $request->title;
    	$data->description = $request->description;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	return redirect()->route('why-us.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = WhyUs::find($id);
    	return view('frontend.why-us.add-why-us',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = WhyUs::find($id);
    	$data->title = $request->title;
    	$data->description = $request->description;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	return redirect()->route('why-us.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $whyUs  = WhyUs::find($id); 
        $whyUs->delete();
        return redirect()->route('why-us.view')->with('success','Data deleted successfully!');

    }
}
