@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Teacher Salary</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Teacher Salary</li>
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
                   Teacher Salary Increment
                   <a class="btn btn-success float-right btn-sm" href="{{route('teachers.salary.view')}}"><i class="fa fa-list"></i> Teacher List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{route('teachers.salary.store',$editData->id)}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                      <div class="form-row">       
                        <div class="form-group col-md-4">
                          <label for="name">Salary Amount</label>
                            <input type="text" name="increment_salary" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="name">Effected Date</label>
                            <input type="text" name="effected_date" class="form-control singledatepicker" autocomplete="off" placeholder="Date">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 30px;">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
      "increment_salary": {
        required: true,
      },
      "effected_date": {
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
