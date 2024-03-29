<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Slider;

class SliderController extends Controller
{
    public function view()
    {	
    	$data['allData']=Slider::all();
    	return view('frontend.slider.view-slider',$data);
    }

    public function add()
    {
    	return view('frontend.slider.add-slider');
    }

    public function store(Request $request)
    {
    	$data = new Slider();
    	$data->short_title = $request->short_title;
    	$data->long_title = $request->long_title;
    	$data->created_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/slider_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('sliders.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Slider::find($id);
    	return view('frontend.slider.add-slider',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Slider::find($id);
    	$data->short_title = $request->short_title;
    	$data->long_title = $request->long_title;
    	$data->updated_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/slider_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/slider_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('sliders.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $slider  = Slider::find($id);
        if(file_exists('public/upload/slider_images/' . $slider->image) AND ! empty($slider->image)){
            unlink('public/upload/slider_images/' . $slider->image);
        } 

        $slider->delete();
        return redirect()->route('sliders.view')->with('success','Data deleted successfully!');

    }
}
