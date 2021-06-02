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
                   Teacher Salary List
                   <a class="btn btn-success float-right btn-sm" href="{{route('accounts.teacher.salary.add')}}"><i class="fa fa-plus-circle"></i> Add/Edit Teacher Salary</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <th>SL.</th>
                             <th>ID No</th>
                             <th>Name</th>
                             <th>Amount</th>
                             <th>Date</th>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $data)
                          <tr class="{{$data->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{$data['user']['id_no']}}</td>
                            <td>{{$data['user']['name']}}</td>
                            <td>{{$data->amount}} TK</td> 
                            <td>{{date('M-Y',strtotime($data->date))}}</td>
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