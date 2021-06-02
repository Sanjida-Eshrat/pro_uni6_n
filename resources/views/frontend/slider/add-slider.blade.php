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
                  @if(isset($editData))
                   Edit Slider
                  @else 
                   Add Slider
                  @endif 
                   <a class="btn btn-primary float-right btn-sm" href="{{route('sliders.view')}}"><i class="fa fa-list"></i>  Slider List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{(@$editData)?route('sliders.update',$editData->id):route('sliders.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                      <div class="form-row">
                      	<div class="form-group col-md-6">
                          <label for="short_title">Short Title</label>
                            <input type="text" name="short_title" value="{{(@$editData->short_title)}}" class="form-control">
                        </div> 
                        <div class="form-group col-md-6">
                          <label for="long_title">Long Title</label>
                            <input type="text" name="long_title" value="{{(@$editData->long_title)}}" class="form-control">
                        </div>
                      	<div class="form-group col-md-4">
                          <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>      
                        <div class="form-group col-md-4">
                           <img  id="showImage" src="{{(!empty($editData->image))?url('/upload/slider_images/'.$editData->image):url('/upload/d.png')}}" style="width: 70px;height: 90px; border: 1px solid #000;">
                        </div>
                        <div class="form-group col-md-3" style="padding-top: 30px;">
                           <button type="submit" class="btn btn-primary btn-sm">{{(@$editData)?'Update':'Submit'}}</button>
                        </div>
                        
                      </div>
                  </form>


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