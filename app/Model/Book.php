<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     public function book_category(){
    	return $this->belongsTo(BookCategory::class,'book_category_id','id');
    }
    public function author(){
    	return $this->belongsTo(Author::class,'author_id','id');
    }
}
