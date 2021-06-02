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
          <li class="breadcrumb-item active">Teacher</li>
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
                    Teacher List
                   <a class="btn btn-success float-right btn-sm" href="{{route('teachers.reg.add')}}"><i class="fa fa-plus-circle"></i> Add Teacher</a>
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
                             @if(Auth::user()->role=="Admin")
                             <td>Code</td> 
                             @endif
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
                              <img  src="{{(!empty($value->image))?url('/upload/Teacher_images/'.$value->image):url('/upload/d.png')}}" style="width: 70px; height: 80px; border: 1px solid #000;">
                            </td>
                            @if(Auth::user()->role=="Admin")
                             <td>{{$value->code}}</td> 
                             @endif
                            <td>
                              <a title="Edit" class="btn btn-sm btn-primary" href="{{route('teachers.reg.edit',$value->id)}}"><i class="fa fa-edit"></i></a>
                              <a title="Details" target="_blank" class="btn btn-sm btn-secondary" href="{{route('teachers.reg.details-n',$value->id)}}"><i class="fa fa-user"></i></a>
                              
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