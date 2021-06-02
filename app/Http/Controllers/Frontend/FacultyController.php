<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Faculty;

class FacultyController extends Controller
{
    public function view()
    {	
    	$data['allData']= Faculty::all();
    	return view('frontend.faculty_member.view-faculty-member',$data);
    }

    public function add()
    {
    	return view('frontend.faculty_member.add-faculty-member');
    }

    public function store(Request $request)
    {
    	$data = new Faculty();
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->department = $request->department;
        if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/teacher_images'),$filename);
           $data['image']=$filename;

        }
        $data->save();
        return redirect()->route('faculty.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Faculty::find($id);
    	return view('frontend.faculty_member.add-faculty-member',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Faculty::find($id);
    	$data->name = $request->name;
        $data->designation = $request->designation;
        $data->department = $request->department;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/teacher_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/teacher_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('faculty.view')->with('success','Data updated successfully!');
    }

   public function delete($id)
    {
        $faculty  = Faculty::find($id);
        if(file_exists('public/upload/logo_images/' . $faculty->image) AND ! empty($faculty->image)){
            unlink('public/upload/teacher_images/' . $faculty->image);
        } 

        $faculty->delete();
        return redirect()->route('faculty.view')->with('success','Data deleted successfully!');

    }
}
