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
          <li class="breadcrumb-item active">Students</li>
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
                  Student List
                  @if(Auth::user()->role=='Admin')
                   <a class="btn btn-success float-right btn-sm" href="{{route('students.registration.add')}}"><i class="fa fa-plus-circle"></i> Add Student</a>
                   @endif
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <form method="GET" action="{{route('students.search.student')}}" id="myForm">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                          <label> Department<font style="color:red"> *</font></label>
                            <select name="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}" {{(@$department_id==$dept->id)?"selected":""}}>{{$dept->name}}</option>
                              @endforeach
                            </select>
                    </div>
                   <div class="form-group col-md-4">
                          <label> Session<font style="color:red"> *</font></label>
                            <select name="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}" {{(@$session_id==$session->id)?"selected":""}}>{{$session->name}}</option>
                              @endforeach
                            </select>
                    </div>
                     <div class="form-group col-md-4">
                          <label> Semester<font style="color:red"> *</font></label>
                            <select name="semester_id" class="form-control form-control-sm">
                              <option value="">Select Semester</option>
                              @foreach($semesters as $sem)
                              <option value="{{$sem->id}}" {{(@$semester_id==$sem->id)?"selected":""}}>{{$sem->name}}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-info btn-sm" name="search">Search</button>
                    </div>
                  </div>
                  
                </form>
              </div>
              <div class="card-body">
                  @if(!@$search)
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <th width="7%">SL.</th>
                             <th>Name</th>
                             <th>ID No</th>
                             <th>Roll</th> 
                             <th>Session</th>
                             <th>Department</th>
                             <th>Semester</th>
                             <th>Image</th>
                             @if(Auth::user()->role=="Admin")
                             <th>Code</th> 
                             @endif
                             <th width="14%">Action</th>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $value)
                          <tr class="{{$value->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{$value['student']['name']}}</td>
                            <td>{{$value['student']['id_no']}}</td>
                            <td>{{$value->roll}}</td>
                            <td>{{$value['session']['name']}}</td>
                            <td>{{$value['department']['name']}}</td>
                            <td>{{$value['semester']['name']}}</td>
                            <td>
                              <img  src="{{(!empty($value['student']['image']))?url('/upload/student_images/'.$value['student']['image']):url('/upload/d.png')}}" style="width: 70px; height: 80px; border: 1px solid #000;">
                            </td>
                            @if(Auth::user()->role=="Admin")
                             <td>{{$value['student']['code']}}</td> 
                             @endif
                            <td>
                              @if(Auth::user()->role=="Admin")
                              <a title="Edit" class="btn btn-sm btn-outline-info" href="{{route('students.registration.edit',$value->student_id)}}"><i class="fa fa-edit"></i></a>
                              <a title="Promotion" class="btn btn-sm btn-outline-success" href="{{route('students.registration.promotion',$value->student_id)}}"><i class="fa fa-check"></i></a>
                              @endif
                              <a target="_blank" title="Details" class="btn btn-sm btn-outline-secondary" href="{{route('students.registration.details-n',$value->student_id)}}"><i class="fa fa-user"></i></a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      
                  </table>
                  @else
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td width="7%">SL.</td>
                             <td>Name</td>
                             <td>ID No</td>
                             <td>Roll</td> 
                             <td>Session</td>
                             <td>Department</td>
                             <td>Semester</td>
                             <td>Image</td>
                             @if(Auth::user()->role=="Admin")
                             <td>Code</td> 
                             @endif 
                             <td width="14%">Action</td>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $value)
                          <tr class="{{$value->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{$value['student']['name']}}</td>
                            <td>{{$value['student']['id_no']}}</td>
                            <td>{{$value->roll}}</td>
                            <td>{{$value['session']['name']}}</td>
                            <td>{{$value['department']['name']}}</td>
                            <td>{{$value['semester']['name']}}</td>
                            <td>
                              <img  src="{{(!empty($value['student']['image']))?url('/upload/student_images/'.$value['student']['image']):url('/upload/d.png')}}" style="width: 70px; height: 80px; border: 1px solid #000;">
                            </td>
                            @if(Auth::user()->role=="Admin")
                             <td>{{$value['student']['code']}}</td> 
                             @endif
                            <td>
                              @if(Auth::user()->role=="Admin")
                              <a title="Edit" class="btn btn-sm btn-outline-info" href="{{route('students.registration.edit',$value->student_id)}}"><i class="fa fa-edit"></i></a>
                               <a title="Promotion" class="btn btn-sm btn-outline-success" href="{{route('students.registration.promotion',$value->student_id)}}"><i class="fa fa-check"></i></a>
                               @endif
                                <a  target="_blank" title="Details" class="btn btn-sm btn-outline-secondary" href="{{route('students.registration.details-n',$value->student_id)}}"><i class="fa fa-user"></i></a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      
                  </table>
                  @endif

              </div><!-- /.card-body -->
            </div>  

            <!-- /.card -->  
             
          </section>
          <script type="text/javascript">
            $(document).ready(function () {
              
              $('#myForm').validate({
                rules: {
                 
                  "department_id": {
                    required: true,
                  },
                  "session_id": {
                    required: true,
                  },
                  "semester_id": {
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