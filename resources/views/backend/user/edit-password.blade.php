@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Password Settings</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">User</li>
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
                   Manege Password
                   <a class="btn btn-success float-right btn-sm" href="{{route('profiles.view')}}"><i class="fa fa-list"></i>  Your Profile</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{route('profiles.password.update')}}" method="post" id="myForm">
                    @csrf
                      <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                          
                        </div>
                         <div class="form-group col-md-4">
                          <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control">
                          
                        </div>
                        <div class="form-group col-md-4">
                          <label for="confirm_password">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
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

    <script type="text/javascript">
$(document).ready(function () {
 
  $('#myForm').validate({
    rules: {
      
      current_password: {
        required: true,
       
      },
      new_password: {
        required: true,
        minlength: 6
      },
      confirm_password: {
        required: true,
        equalTo : '#new_password'
      },
      
    },
    messages: {
     
      current_password: {
        required: "Please enter your current password.",
      },
      new_password: {
        required: "Please enter a new password.",
        minlength: "Your password must be at least 6 characters long."
      },
      confirm_password: {
        required: "Please enter your new password to confirm.",
        equalTo: "Confirm password does not match."
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
 <!-- /.content -->   
@endsection