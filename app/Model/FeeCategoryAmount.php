<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
     public function fee_category(){
    	return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }

     public function department(){
    	return $this->belongsTo(Department::class,'department_id','id');
    }
}
