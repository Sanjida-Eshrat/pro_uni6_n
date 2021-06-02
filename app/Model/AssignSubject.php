<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
     public function department(){
    	return $this->belongsTo(Department::class,'department_id','id');
    }
    public function subject(){
    	return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
