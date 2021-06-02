@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Teacher Details</h1>
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
          <section class="col-md-14 offset-md-4">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img  src="{{(!empty($details->image))?url('/upload/teacher_images/'.$details->image):url('/upload/d.png')}}" style="width: 70px; height: 80px; border: 1px solid #000;">
                </div>

                <h3 class="profile-username text-center">{{$details->name}}</h3>

                <p class="text-muted text-center">{{$details['designation']['name']}}</p>

                <table width="100%" class="table table-bordered">
                  <tbody>
                  	<tr>
                      <td>Father's Name</td>
                      <td>{{$details->fname}}</td>
                    </tr>
                    <tr>
                      <td>Mother's Name</td>
                      <td>{{$details->mname}}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{$details->address}}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$details->email}}</td>
                    </tr>
                     <tr>
                      <td>Date of Birth</td>
                      <td>{{$details->dob}}</td>
                    </tr>
                    <tr>
                      <td>Blood Group</td>
                      <td>{{$details->blood_group}}</td>
                    </tr>
                  </tbody>
                </table>

                <a href="{{route('teachers.reg.view')}}" class="btn btn-primary btn-block"><b>Back</b></a>
              </div>
              <!-- /.card-body -->
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