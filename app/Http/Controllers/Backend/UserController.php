<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function view()
    {
    	$data['allData']=User::where('usertype','admin')->get();
    	return view('backend.user.view-user',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.user.add-user');
    }

    public function store(Request $request)
    {

    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required|unique:users,email'
    	]);
        $code = rand(0000,9999);
    	$data = new User();
    	$data->usertype = 'admin';
        $data->role = $request->role;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($code);
        $data->code = $code;
    	$data->save();
    	return redirect()->route('users.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = User::find($id);
    	return view('backend.user.edit-user',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = User::find($id);
    	$data->usertype = $request->usertype;
    	$data->name = $request->name;
    	$data->email = $request->email;
        $data->role = $request->role;
    	$data->save();
    	return redirect()->route('users.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $user  = User::find($id);
        if(file_exists('public/upload/user_images/' . $user->image) AND ! empty($user->image)){
            unlink('public/upload/user_images/' . $user->image);
        }

        $user->delete();
        return redirect()->route('users.view')->with('success','Data deleted successfully!');

    }

  /*  public function delete(Request $request)
    {
        $user  = User::find($request->id);
        if(file_exists('public/upload/user_images/' . $user->image) AND ! empty($user->image)){
            unlink('public/upload/user_images/' . $user->image);
        }

        $user->delete();
        return redirect()->route('users.view')->with('success','Data deleted successfully!');

    }*/
}
