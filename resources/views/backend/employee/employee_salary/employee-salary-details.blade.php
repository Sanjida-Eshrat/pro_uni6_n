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
          <li class="breadcrumb-item active">Employee Salary</li>
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
                    Employee Salary Details
                    <a class="btn btn-success float-right btn-sm" href="{{route('employees.salary.view')}}"><i class="fa fa-plus-circle"></i> Employee List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <strong>Employee Name :</strong> {{$details->name}}, <strong>Employee ID No :</strong>{{$details->id_no}}
           		<table class="table table-bordered table-hover">
           		   <thead>
           		   	  <tr>
           		   	    <td>SL.</td>
                        <td>Previous Salary</td>
                        <td>Increment Salary</td>
                        <td>Present Salary</td>
                        <td>Effected Date</td>
           		   	  </tr>
           		   </thead>	
           		   <tbody>
           		   	@foreach($salary_log as $key => $value)
           		   	<tr>
           		   		@if($key=="0")
           		   		<td class="text-center" colspan="5"><strong>Joining Salary :</strong> {{$value->previous_salary}}</td>
           		   		@else
           		   	    <td>{{$key+1}}</td>
                        <td>{{$value->previous_salary}}</td>
                        <td>{{$value->increment_salary}}</td>
                        <td>{{$value->present_salary}}</td>
                        <td>{{date('d-m-Y',strtotime($value->effected_date))}}</td>
                        @endif
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