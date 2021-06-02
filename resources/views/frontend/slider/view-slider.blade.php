@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Slider</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Slider</li>
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
                    Slider List
                   <a class="btn btn-success float-right btn-sm" href="{{route('sliders.add')}}"><i class="fa fa-plus-circle"></i> Add Slider</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>Image</td>
                             <td>Short Title</td>
                             <td>Long Title</td>
                             <td>Action</td>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $slider)
                          <tr class="{{$slider->id}}">
                            <td>{{$key+1}}</td>
                            <td>
                              <img  src="{{(!empty($slider->image))?url('/upload/slider_images/'.$slider->image):url('/upload/d.png')}}" style="width: 40px; height: 50px; border: 1px solid #000;">
                            </td>
                            <td>{{$slider->short_title}}</td>
                            <td>{{$slider->long_title}}</td>
                            <td>
                              <a title="Edit" class="btn btn-sm btn-primary" href="{{route('sliders.edit',$slider->id)}}"><i class="fa fa-edit"></i></a>
                              <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{route('sliders.delete',$slider->id)}}"><i class="fa fa-trash"></i></a>
                              
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