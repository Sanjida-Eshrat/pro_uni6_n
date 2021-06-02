<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Auth;
use App\Model\AboutUs;
use App\Model\Testimonial;
use App\Model\Logo;

class AboutUsController extends Controller
{
    public function view()
    {	
        $data['countAboutUs']=AboutUs::count();
    	$data['allData']=AboutUs::all();
    	return view('frontend.about-us.view-about-us',$data);
    }

    public function add()
    {
    	return view('frontend.about-us.add-about-us');
    }

    public function store(Request $request)
    {
    	$data = new AboutUs();
    	$data->head_title = $request->head_title;
    	$data->first_part = $request->first_part;
    	$data->second_part = $request->second_part;
    //	$data->created_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/aboutus_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('about-us.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = AboutUs::find($id);
    	return view('frontend.about-us.add-about-us',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = AboutUs::find($id);
    	$data->head_title = $request->head_title;
    	$data->first_part = $request->first_part;
    	$data->second_part = $request->second_part;
    	//$data->updated_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/aboutus_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/aboutus_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('about-us.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $aboutus  = AboutUs::find($id);
        if(file_exists('public/upload/logo_images/' . $aboutus->image) AND ! empty($aboutus->image)){
            unlink('public/upload/aboutus_images/' . $aboutus->image);
        } 

        $aboutus->delete();
        return redirect()->route('about-us.view')->with('success','Data deleted successfully!');

    }

}
