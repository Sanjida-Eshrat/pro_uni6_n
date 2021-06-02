@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Roll Generate</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Roll Generate</li>
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
                  Search Criteria
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <form method="POST" action="{{route('students.roll.store')}}" id="myForm">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                          <label> Department<font style="color:red"> *</font></label>
                            <select name="department_id" id="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}">{{$dept->name}}</option>
                              @endforeach
                            </select>
                    </div>
                   <div class="form-group col-md-4">
                          <label> Session<font style="color:red"> *</font></label>
                            <select name="session_id" id="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}">{{$session->name}}</option>
                              @endforeach
                            </select>
                    </div>
                   <div class="form-group col-md-4">
                          <label> Semester<font style="color:red"> *</font></label>
                            <select name="semester_id" id="semester_id" class="form-control form-control-sm">
                              <option value="">Select Semester</option>
                              @foreach($semesters as $sem)
                              <option value="{{$sem->id}}">{{$sem->name}}</option>
                              @endforeach
                            </select>
                    </div> 

                    <div class="form-group col-md-4" style="padding-top: 30px;">
                      <a id="search" class="btn btn-info btn-sm" name="search" style="color:white">Search</a>
                    </div>
                  </div><br>

                  <div class="row d-none" id="roll-generate">
                    <div class="col-md-12">
                      <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                        <thead>
                          <tr>
                            <th>ID No</th>
                            <th>Student Name</th>
                            <th>Father's Name</th>
                            <th>Roll No</th>
                          </tr>
                        </thead>
                        <tbody id="roll-generate-tr"> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-sm">Roll Generate</button>
                </form>
              </div>
              
            </div>  

            <!-- /.card -->  
             
          </section>


          <script type="text/javascript">
            $(document).on('click','#search',function(){
              var department_id =$('#department_id').val();
              var session_id = $('#session_id').val();
              var semester_id = $('#semester_id').val();
              $('.notifyjs-corner').html('');

              if(department_id ==''){
                $.notify("Department required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              if(session_id ==''){
                $.notify("Session required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              if(semester_id ==''){
                $.notify("Semester required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              
              $.ajax({
                url: "{{route('students.roll.get-student')}}",
                type: "GET",
                data: {'department_id':department_id,'session_id':session_id,'semester_id':semester_id},
                success: function(data){
                  $('#roll-generate').removeClass('d-none');
                  var html = '';
                  $.each(data,function(key, v){
                    html +=
                    '<tr>'+
                    ' <td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                    '<td>'+v.student.name+'</td>'+
                    '<td>'+v.student.fname+'</td>'+
                   '<td><input type="text" class="form-control form-control-sm" name="roll[]" value"'+v.roll+'"></td>'+
                    '</tr>';
                  });
                  html = $('#roll-generate-tr').html(html);
                }
              });
            });
          </script>

          <script type="text/javascript">
              $(document).ready(function () {
                
                $('#myForm').validate({
                  rules: {
                   
                    "roll[]": {
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
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
 <!-- /.content -->   
@endsection