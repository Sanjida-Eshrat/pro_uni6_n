@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Fee Category Amount</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Fee Amount</li>
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
                    Fee Amount Details
                   <a class="btn btn-success float-right btn-sm" href="{{route('setups.fee.amount.view')}}"><i class="fa fa-plus-list"></i> Fee Amount List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
              	<h4><strong>Fee Category :</strong> {{$editData['0']['fee_category']['name']}}</h4>
              	<table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>Department</td>
                             <td>Amount</td>
                          </tr> 
                      </thead>
                      <tbody>

                        @foreach($editData as $key => $value)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value['department']['name']}}</td>
                    		<td>{{$value->amount}}</td>
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