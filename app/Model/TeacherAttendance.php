<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TeacherAttendance extends Model
{
    public function user(){
    	return $this->belongsTo(User::class,'teacher_id','id');
    }
}
