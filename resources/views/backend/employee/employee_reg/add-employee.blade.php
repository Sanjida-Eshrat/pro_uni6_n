@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Employees</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Employee</li>
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
                   Edit Employee
                  @else 
                   Add Employee
                  @endif 
                   <a class="btn btn-success float-right btn-sm" href="{{route('employees.reg.view')}}"><i class="fa fa-list"></i>  Employee List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{(@$editData)?route('employees.reg.update',$editData->id):route('employees.reg.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                   
                      <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label> Employee's Name<font style="color:red"> *</font></label>
                            <input type="text" name="name" value="{{@$editData->name}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Father's Name<font style="color:red"> *</font></label>
                            <input type="text" name="fname" value="{{@$editData->fname}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Mother's Name<font style="color:red"> *</font></label>
                            <input type="text" name="mname" value="{{@$editData->mname}}" class="form-control form-control-sm">     
                        </div>
                        <div class="form-group col-md-4">
                          <label> Mobile No<font style="color:red"> *</font></label>
                            <input type="text" name="phone" value="{{@$editData->phone}}" class="form-control form-control-sm">   
                        </div>
                        <div class="form-group col-md-4">
                          <label> Address<font style="color:red"> *</font></label>
                          <input type="text" name="address" value="{{@$editData->address}}" class="form-control form-control-sm">
     
                        </div>
                         <div class="form-group col-md-4">
                          <label> Email<font style="color:red"> *</font></label>
                            <input type="text" name="email" value="{{@$editData->email}}" class="form-control form-control-sm">
                            
                        </div>
                         <div class="form-group col-md-4">
                          <label> Gender<font style="color:red"> *</font></label>
                            <select name="gender" class="form-control form-control-sm">
                              <option value="">Select Gender</option>
                              <option value="Male" {{(@$editData->gender=='Male')?'selected':''}}>Male</option>
                              <option value="Female" {{(@$editData->gender=='Female')?'selected':''}}>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Religion<font style="color:red"> *</font></label>
                            <select name="religion" class="form-control form-control-sm">
                              <option value="">Select Religion</option>
                              <option value="Islam" {{(@$editData->religion=='Islam')?'selected':''}}>Islam</option>
                               <option value="Hinduism" {{(@$editData->religion=='Hinduism')?'selected':''}}>Hinduism</option>
                               <option value="Christianity" {{(@$editData->religion=='Christianity')?'selected':''}}>Christianity</option>
                               <option value="Buddhism" {{(@$editData->religion=='Buddhism')?'selected':''}}>Buddhism</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Blood Group</label>
                            <select name="blood_group" class="form-control form-control-sm">
                              <option value="">Select Blood Group</option>
                              <option value="A+" {{(@$editData->blood_group=='A+')?'selected':''}}>A+</option>
                              <option value="A-" {{(@$editData->blood_group=='A-')?'selected':''}}>A-</option>
                              <option value="B+" {{(@$editData->blood_group=='B+')?'selected':''}}>B+</option>
                              <option value="B-" {{(@$editData->blood_group=='B-')?'selected':''}}>B-</option>
                              <option value="AB+" {{(@$editData->blood_group=='AB+')?'selected':''}}>AB+</option>
                              <option value="AB-" {{(@$editData->blood_group=='AB-')?'selected':''}}>AB-</option>
                              <option value="O+" {{(@$editData->blood_group=='O+')?'selected':''}}>O+</option>
                              <option value="O-" {{(@$editData->blood_group=='O-')?'selected':''}}>O-</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label> Date of Birth<font style="color:red"> *</font></label>
                            <input type="text" name="dob" value="{{@$editData->dob}}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                          <label> Designation<font style="color:red"> *</font></label>
                            <select name="designation_id" class="form-control form-control-sm">
                              <option value="">Select Designation</option>
                              @foreach($designations as $desig)
                              <option value="{{$desig->id}}" {{(@$editData->designation_id==$desig->id)?"selected":""}}>{{$desig->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Join Date<font style="color:red"> *</font></label>
                            <input type="text" name="join_date" value="{{@$editData->join_date}}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                        </div>
                       
                        <div class="form-group col-md-4">
                          <label>Salary</label>
                            <input type="text" name="salary" value="{{@$editData->salary}}" class="form-control form-control-sm">
                        </div>

                        <div class="form-group col-md-4">
                          <label> Image</label>
                          <input type="file" name="image" class="form-control form-control-sm" id="image">  
                        </div>
                        <div>
                          <img id="showImage" src="{{(!empty($editData->image))?url('/upload/employee_images/'.$editData->image):url('/upload/d.png')}}" style="width: 100px; height: 110px; border: 1px solid #000;">
                        </div>

                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary btn-sm">{{(@$editData)?'Update':'Submit'}}</button>
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
      "join_date": {
        required: true,
      },
       "designation_id": {
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
