@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Teachers</h1>
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
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>Name</td>
                             <td>ID No</td>
                             <td>Phone</td>
                             <td>Address</td>
                             <td>Join Date</td>
                             <td>Salary</td>
                             <td>Image</td>
                             
                             <td>Action</td>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $value)
                          <tr class="{{$value->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{$value->name}}</td>
                             <td>{{$value->id_no}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->address}}</td>
                            <td>{{date('d-m-Y',strtotime($value->join_date))}}</td>
                            <td>{{$value->salary}}</td>
                            <td>
                              <img  src="{{(!empty($value->image))?url('/upload/teacher_images/'.$value->image):url('/upload/d.png')}}" style="width: 70px; height: 80px; border: 1px solid #000;">
                            </td>
                           
                            <td>
                              <a title="Salary Increment" class="btn btn-sm btn-primary" href="{{route('teachers.salary.increment',$value->id)}}"><i class="fa fa-plus-circle"></i></a>
                              <a title="Salary View" target="_blank" class="btn btn-sm btn-secondary" href="{{route('teachers.salary.details',$value->id)}}"><i class="fa fa-user"></i></a>
                              
                            </td>
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