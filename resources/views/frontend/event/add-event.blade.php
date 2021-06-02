@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Event</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Event</li>
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
                   Edit Event
                  @else 
                   Add Event
                  @endif 
                   <a class="btn btn-primary float-right btn-sm" href="{{route('event.view')}}"><i class="fa fa-list"></i>  Event List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{(@$editData)?route('event.update',$editData->id):route('event.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                      <div class="form-row">
                      	<div class="form-group col-md-6">
                          <label for="title">Title</label>
                            <input type="text" name="title" value="{{(@$editData->title)}}" class="form-control">
                        </div> 
                        <div class="form-group col-md-6">
                          <label for="date">Date</label>
                            <input type="text" name="date" value="{{(@$editData->date)}}"
                            class="form-control singledatepicker" >
                        </div>
                        <div class="form-group col-md-12">
                          <label for="description">Description</label>
                          <textarea name="description"  rows="5" class="form-control">{{@$editData->description}}</textarea>
                        </div> 
                      	<div class="form-group col-md-4">
                          <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>      
                        <div class="form-group col-md-4">
                           <img  id="showImage" src="{{(!empty($editData->image))?url('/upload/event_images/'.$editData->image):url('/upload/d.png')}}" style="width: 100px;height: 110px; border: 1px solid #000;">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 30px;">
                           <button type="submit" class="btn btn-primary ">{{(@$editData)?'Update':'Submit'}}</button>
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