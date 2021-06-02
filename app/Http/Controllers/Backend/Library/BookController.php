<?php

namespace App\Http\Controllers\Backend\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Author;
use App\Model\BookCategory;
use App\Model\Book;
use DB;

class BookController extends Controller
{
    public function view()
    {  //dd('ok');
      $data['allData']=Book::select('book_category_id')->groupBy('book_category_id')->get();

      return view('backend.library.books.view-books',$data);
      
    }

    public function add()
    {
      $data['book_categories']=BookCategory::all();
      $data['authors']=Author::all();
      return view('backend.library.books.add-books',$data);
    }
    
    public function store(Request $request)
    {
      $countAuthor = count($request->author_id);
      if($countAuthor !=Null){
        for($i=0; $i <$countAuthor; $i++){
          $book = new Book();
          $book->book_category_id = $request->book_category_id;
          $book->author_id = $request->author_id[$i];
          $book->bookTitle = $request->bookTitle[$i];
          $book->edition = $request->edition[$i];
          $book->totalAvail = $request->totalAvail[$i];
          $book->save();
        }
      }
      return redirect()->route('library.books.view')->with('success','Data inserted successfully!'); 
    } 
}