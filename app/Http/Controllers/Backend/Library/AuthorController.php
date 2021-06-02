<?php

namespace App\Http\Controllers\Backend\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Author;
use App\Model\BookCategory;
use App\Model\Book;
use DB;
class AuthorController extends Controller
{
   public function view()
    {
    	$data['allData']=Author::all();
	    return view('backend.library.authors.view-author',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.library.authors.add-author');
    }

    public function store(Request $request)
    {
    	$data = new Author();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('library.authors.view')->with('success','Data inserted successfully!');
    }
    public function edit($id)
    {
    	$editData = Author::find($id);
    	return view('backend.library.authors.add-author',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = Author::find($id);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('library.authors.view')->with('success','Data updated successfully!');
    }

    public function delete(Request $request)
    {
    	//dd('ok');
        $data  = Author::find($request->id);

        $data->delete();
        return redirect()->route('library.authors.view')->with('success','Data deleted successfully!');

    }
}
