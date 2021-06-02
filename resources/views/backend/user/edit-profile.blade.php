@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
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
                   Edit User Profile
                   <a class="btn btn-primary float-right btn-sm" href="{{route('profiles.view')}}"><i class="fa fa-user"></i>  Your profile</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{route('profiles.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                      <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="name">Name</label>
                            <input type="text" name="name" value="{{$editData->name}}" class="form-control">
                            <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="email">Email</label>
                            <input type="text" name="email" value="{{$editData->email}}" class="form-control">
                            <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                        </div>
                         <div class="form-group col-md-4">
                          <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>       
                        <div class="form-group col-md-3">
                           <img  id="showImage" src="{{(!empty($editData->image))?url('/upload/user_images/'.$editData->image):url('/upload/d.png')}}" style="width: 150px;height: 160px; border: 1px solid #000;">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                        
                      </div>
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
 <!-- /.content -->

     <script type="text/javascript">
$(document).ready(function () {
  
  $('#myForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
     
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      
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
@endsection