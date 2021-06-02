<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Testimonial;
use App\Model\AboutUs;
use App\Model\Logo;

class TestimonialController extends Controller
{
    public function view()
    {	
    	$data['allData']= Testimonial::all();
    	return view('frontend.testimonial.view-testimonial',$data);
    }

    public function add()
    {
    	return view('frontend.testimonial.add-testimonial');
    }

    public function store(Request $request)
    {
    	$data = new Testimonial();
        $data->test_name = $request->test_name;
        $data->test_designation = $request->test_designation;
        $data->description = $request->description;
        $data->created_by = Auth::user()->id;
        if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/testimonial_images'),$filename);
           $data['image']=$filename;

        }
        $data->save();
        return redirect()->route('testimonials.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Testimonial::find($id);
    	return view('frontend.testimonial.add-testimonial',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Testimonial::find($id);
        $data->test_name = $request->test_name;
        $data->test_designation = $request->test_designation;
        $data->description = $request->description;
    	$data->updated_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/testimonial_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/testimonial_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('testimonials.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $testimonial  = Testimonial::find($id);
        if(file_exists('public/upload/logo_images/' . $testimonial->image) AND ! empty($testimonial->image)){
            unlink('public/upload/testimonial_images/' . $testimonial->image);
        } 

        $testimonial->delete();
        return redirect()->route('testimonials.view')->with('success','Data deleted successfully!');

    }

    
}
