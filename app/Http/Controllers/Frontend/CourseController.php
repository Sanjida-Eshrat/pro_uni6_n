<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Course;
use App\Model\Logo;

class CourseController extends Controller
{
    public function view()
    {	
    	$data['allData']=Course::all();
    	return view('frontend.courses.view-course',$data);
    }

    public function add()
    {
    	return view('frontend.courses.add-course');
    }

    public function store(Request $request)
    {
    	$data = new Course();
    	$data->head_title = $request->head_title;
    	$data->big_title = $request->big_title;
    	$data->small_title = $request->long_title;
    	$data->created_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/course_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('courses.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Course::find($id);
    	return view('frontend.courses.add-course',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Course::find($id);
    	$data->head_title = $request->head_title;
    	$data->big_title = $request->big_title;
    	$data->small_title = $request->small_title;
    	$data->updated_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/course_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/course_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('courses.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $course  = Course::find($id);
        if(file_exists('public/upload/logo_images/' . $course->image) AND ! empty($course->image)){
            unlink('public/upload/course_images/' . $course->image);
        } 

        $course->delete();
        return redirect()->route('courses.view')->with('success','Data deleted successfully!');

    }

    
}
