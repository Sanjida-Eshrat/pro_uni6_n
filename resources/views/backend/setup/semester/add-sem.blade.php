@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Semesters</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Semesters</li>
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
                   Edit Semester
                  @else 
                   Add Semester
                  @endif 
                   <a class="btn btn-success float-right btn-sm" href="{{route('setups.semester.view')}}"><i class="fa fa-list"></i>  Semester List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{(@$editData)?route('setups.semester.update',$editData->id):route('setups.semester.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                      <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="name">Semester Name</label>
                            <input type="text" name="name" value="{{(@$editData->name)}}" class="form-control">
                            <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                        </div>
                        
                        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <button type="submit" class="btn btn-primary">{{(@$editData)?'Update':'Submit'}}</button>
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
      name: {
        required: true,
        name: true,
      },
      
    },
    messages: {
      name: {
        required: "Please enter semester name",
        name: "Semester name already exists."
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
