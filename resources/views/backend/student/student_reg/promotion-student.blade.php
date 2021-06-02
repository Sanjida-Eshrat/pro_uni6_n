@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Students</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Student</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <br>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            
              <div class="card">
              <div class="card-header">
                <h3>
                  @if(isset($editData))
                   Student Promotion
                  @else 
                   Add Student
                  @endif 
                   <a class="btn btn-success float-right btn-sm" href="{{route('students.registration.view')}}"><i class="fa fa-list"></i>  Student List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{route('students.registration.promotion.store',$editData->student_id)}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                   
                     <input type="hidden" name="id" value="{{@$editData->id}}"> 
                            <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label> Student's Name<font style="color:red"> *</font></label>
                            <input type="text" name="name" value="{{@$editData['student']['name']}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Father's Name<font style="color:red"> *</font></label>
                            <input type="text" name="fname" value="{{@$editData['student']['fname']}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Mother's Name<font style="color:red"> *</font></label>
                            <input type="text" name="mname" value="{{@$editData['student']['mname']}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Mobile No<font style="color:red"> *</font></label>
                            <input type="text" name="phone" value="{{@$editData['student']['phone']}}" class="form-control form-control-sm">   
                        </div>
                        <div class="form-group col-md-4">
                          <label> Address<font style="color:red"> *</font></label>
                          <input type="text" name="address" value="{{@$editData['student']['address']}}" class="form-control form-control-sm">
     
                        </div>
                         <div class="form-group col-md-4">
                          <label> Email<font style="color:red"> *</font></label>
                            <input type="text" name="email" value="{{@$editData['student']['email']}}" class="form-control form-control-sm">
                            
                        </div>
                         <div class="form-group col-md-4">
                          <label> Gender<font style="color:red"> *</font></label>
                            <select name="gender" class="form-control form-control-sm">
                              <option value="">Select Gender</option>
                              <option value="Male" {{(@$editData['student']['gender']=='Male')?'selected':''}}>Male</option>
                              <option value="Female" {{(@$editData['student']['gender']=='Female')?'selected':''}}>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Religion<font style="color:red"> *</font></label>
                            <select name="religion" class="form-control form-control-sm">
                              <option value="">Select Religion</option>
                              <option value="Islam" {{(@$editData['student']['religion']=='Islam')?'selected':''}}>Islam</option>
                              <option value="Hinduism" {{(@$editData['student']['religion']=='Hinduism')?'selected':''}}>Hinduism</option>
                              <option value="Christianity" {{(@$editData['student']['religion']=='Christianity')?'selected':''}}>Christianity</option>
                              <option value="Buddhism" {{(@$editData['student']['religion']=='Buddhism')?'selected':''}}>Buddhism</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Blood Group</label>
                            <select name="blood_group" class="form-control form-control-sm">
                              <option value="">Select Blood Group</option>
                              <option value="A+" {{(@$editData['student']['blood_group']=='A+')?'selected':''}}>A+</option>
                              <option value="A-" {{(@$editData['student']['blood_group']=='A-')?'selected':''}}>A-</option>
                              <option value="B+" {{(@$editData['student']['blood_group']=='B+')?'selected':''}}>B+</option>
                              <option value="B-" {{(@$editData['student']['blood_group']=='B-')?'selected':''}}>B-</option>
                              <option value="AB+" {{(@$editData['student']['blood_group']=='AB+')?'selected':''}}>AB+</option>
                              <option value="AB-" {{(@$editData['student']['blood_group']=='AB-')?'selected':''}}>AB-</option>
                              <option value="O+" {{(@$editData['student']['blood_group']=='O+')?'selected':''}}>O+</option>
                              <option value="O-" {{(@$editData['student']['blood_group']=='O-')?'selected':''}}>O-</option>
                            </select>
                        </div>
                         <div class="form-group col-md-4">
                          <label> Date of Birth<font style="color:red"> *</font></label>
                            <input type="text" name="dob" value="{{@$editData['student']['dob']}}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                        </div>
                         <div class="form-group col-md-4">
                          <label> Discount</label>
                            <input type="text" name="discount" value="{{@$editData['discount']['discount']}}" class="form-control form-control-sm">
                        </div>
                         <div class="form-group col-md-4">
                          <label> Session<font style="color:red"> *</font></label>
                            <select name="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}"  {{(@$editData->session_id==$session->id)?"selected":""}}>{{$session->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Department<font style="color:red"> *</font></label>
                            <select name="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}" {{(@$editData->department_id==$dept->id)?"selected":""}}>{{$dept->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Semester<font style="color:red"> *</font></label>
                            <select name="semester_id" class="form-control form-control-sm">
                              <option value="">Select Semester</option>
                              @foreach($semesters as $sem)
                              <option value="{{$sem->id}}" {{(@$editData->semester_id==$sem->id)?"selected":""}}>{{$sem->name}}</option>
                              @endforeach
                            </select>
                        </div>
                         <div class="form-group col-md-4">
                          <label> Shift</label>
                            <select name="shift_id" class="form-control form-control-sm">
                              <option value="">Select Shift</option>
                              @foreach($shifts as $shift)
                              <option value="{{$shift->id}}" {{(@$editData->shift_id==$shift->id)?"selected":""}}>{{$shift->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Image</label>
                          <input type="file" name="image" class="form-control form-control-sm" id="image">  
                        </div>
                        <div>
                          <img id="showImage" src="{{(!empty($editData['student']['image']))?url('/upload/student_images/'.$editData['student']['image']):url('/upload/d.png')}}" style="width: 100px; height: 110px; border: 1px solid #000;">
                        </div>

                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary btn-sm">{{(@$editData)?'Promotion':'Submit'}}</button>
                  </form> 


              </div><!-- /.card-body -->
            </div>  

            <!-- /.card -->
             
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

   <script type="text/javascript">
$(document).ready(function () {
  
  $('#myForm').validate({
    rules: {
      "name": {
        required: true,
      },
      "fname": {
        required: true,
      },
     "mname": {
        required: true,
      },
      "phone": {
        required: true,
      },
      "address": {
        required: true,
      },
      "email": {
        required: true,
      },
      "gender": {
        required: true,
      },
      "religion": {
        required: true,
      },  

      "dob": {
        required: true,
      },
      "department_id": {
        required: true,
      },
      "session_id": {
        required: true,
      },

    },
    messages: {
    
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
 <!-- /.content -->   
@endsection
