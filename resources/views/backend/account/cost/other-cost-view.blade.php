@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Other Cost</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Other Cost</li>
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
                   Other Cost List
                   <a class="btn btn-success float-right btn-sm" href="{{route('accounts.cost.add')}}"><i class="fa fa-plus-circle"></i> Add/Edit Other Cost</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>Date</td>
                             <td>Amount</td>
                             <td>Description</td>
                             <td>image</td>
                             <td>Action</td>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $data)
                          <tr class="{{$data->id}}">
                            <td>{{$key+1}}</td>
                            <td>{{date('d-m-Y',strtotime($data->date))}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->description}}</td>
                            <td>
                            	<img  src="{{(!empty($data->image))?url('/upload/cost_images/'.$data->image):url('/upload/d.png')}}" style="width: 90px;height:60px;">
                            </td>
                            <td>
                              <a title="Edit" class="btn btn-sm btn-primary" href="{{route('accounts.cost.edit',$data->id)}}"><i class="fa fa-edit"></i></a>
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