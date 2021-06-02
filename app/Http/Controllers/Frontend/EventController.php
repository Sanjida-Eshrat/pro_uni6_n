<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Logo;
use App\Model\Event;

class EventController extends Controller
{
    public function view()
    {	
    	$data['allData']= Event::all();
    	return view('frontend.event.view-event',$data);
    }

    public function add()
    {
    	return view('frontend.event.add-event');
    }

    public function store(Request $request)
    {
    	$data = new Event();
        $data->title = $request->title;
        $data->date = date('Y-m-d',strtotime($request->date));
        $data->description = $request->description;
        $data->created_by = Auth::user()->id;
        if($request->file('image')){
           $file=$request->file('image');
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/event_images'),$filename);
           $data['image']=$filename;

        }
        $data->save();
        return redirect()->route('event.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Event::find($id);
    	return view('frontend.event.add-event',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Event::find($id);
    	$data->title = $request->title;
    	$data->date = date('Y-m-d',strtotime($request->date));
    	$data->description = $request->description;
    	$data->updated_by = Auth::user()->id;
    	if($request->file('image')){
           $file=$request->file('image');
           @unlink(public_path('upload/event_images/'.$data->image));
           $filename=date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/event_images'),$filename);
           $data['image']=$filename;

        }
    	$data->save();
    	return redirect()->route('event.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $event  = Event::find($id);
        if(file_exists('public/upload/logo_images/' . $event->image) AND ! empty($event->image)){
            unlink('public/upload/event_images/' . $event->image);
        } 

        $event->delete();
        return redirect()->route('event.view')->with('success','Data deleted successfully!');

    }

    public function showEvent()
    {   
        $data['logo']= Logo::first();
        $data['events']= Event::all();
        return view('frontend.show-event',$data);
    }
}
