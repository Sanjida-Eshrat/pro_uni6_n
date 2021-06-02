<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AssignStudent extends Model
{
    public function student(){
    	return $this->belongsTo(User::class,'student_id','id');
    }
     public function department(){
    	return $this->belongsTo(Department::class,'department_id','id');
    }
    public function session(){
    	return $this->belongsTo(Session::class,'session_id','id');
    }
    public function semester(){
        return $this->belongsTo(Semester::class,'semester_id','id');
    }
    public function discount(){
    	return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
    }
}
