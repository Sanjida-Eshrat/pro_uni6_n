@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Employee Attendance</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Employee Attendance</li>
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
                    Employee Attendance Details
                   <a class="btn btn-success float-right btn-sm" href="{{route('employees.attendance.view')}}"><i class="fa fa-plus-list"></i>Employee Attendance List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                   <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>ID No</td>
                             <td>Name</td>
                             <td>Date</td>
                             <td>Attend Status</td>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($details as $key => $value)
                          <tr class="{{$value->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{$value['user']['id_no']}}</td>
                            <td>{{$value['user']['name']}}</td>
                            <td>{{ date('d-m-Y',strtotime($value->date))}}</td>
                            <td>{{$value->attend_status}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      
                  </table>


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
@endsection


