<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class MemStudent extends Model
{   
	public function student(){
    	return $this->belongsTo(User::class,'student_id','id');
    }
    public function assignstudent(){
    	return $this->belongsTo(User::class,'assign_student_id','id');
    }
    public function department(){
    	return $this->belongsTo(Department::class,'department_id','id');
    }
    public function session(){
    	return $this->belongsTo(Session::class,'session_id','id');
    }
    
}
