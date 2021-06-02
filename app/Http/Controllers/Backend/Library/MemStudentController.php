<?php

namespace App\Http\Controllers\Backend\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Department; 
use App\Model\Session;
use App\Model\Semester; 
use App\Model\Shift;
use App\Model\Book;
use App\Model\MemStudent;
use App\Model\AssignStudent;
use DB;

class MemStudentController extends Controller
{
    public function view()
    {
        $data['allData'] = AssignStudent::all();
        return view('backend.library.mem_students.view-mem-student',$data);
    }
}
