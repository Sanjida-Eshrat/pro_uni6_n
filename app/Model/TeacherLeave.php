<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TeacherLeave extends Model
{
    public function user(){
    	return $this->belongsTo(User::class,'teacher_id','id');
    }
    public function purpose(){
    	return $this->belongsTo(LeavePurpose::class,'leave_purpose_id','id');
    }
}
