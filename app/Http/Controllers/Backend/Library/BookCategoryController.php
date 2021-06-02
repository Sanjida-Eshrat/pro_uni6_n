<?php

namespace App\Http\Controllers\Backend\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BookCategory;
use DB;

class BookCategoryController extends Controller
{
      public function view()
    {
    	$data['allData']=BookCategory::all();
	    return view('backend.library.book_category.view-book-category',$data);
    	//dd('ok');
    }

    public function add()
    {
    	return view('backend.library.book_category.add-book-category');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required|unique:book_categories,name',
    	]);

    	$data = new BookCategory();
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('library.book.category.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = BookCategory::find($id);
    	return view('backend.library.book_category.add-book-category',compact('editData'));
    }

    public function update(Request $request,$id)
   {	
   		$data = BookCategory::find($id);
        $this->validate($request,[
    		'name'=>'required|unique:book_categories,name'
    	]);
    	$data->name = $request->name;
    	$data->save();
    	return redirect()->route('library.book.category.view')->with('success','Data updated successfully!');
    }

     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = BookCategory::find($request->id);

        $data->delete();
        return redirect()->route('library.book.category.view')->with('success','Data deleted successfully!');

    }
}
