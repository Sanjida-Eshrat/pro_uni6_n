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
                    Event List
                   @if(Auth::user()->role=="Admin")
                   <a class="btn btn-success float-right btn-sm" href="{{route('event.add')}}"><i class="fa fa-plus-circle"></i> Add Event</a>
                   @endif
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <table id="example1" class="table table-bordered table-hover col-md-12">
                      <thead>
                          <tr>
                             <td>SL.</td>
                             <td>Image</td>
                             <td>Title</td>
                             <td>Description</td>
                             <td>Date</td>
                             @if(Auth::user()->role=="Admin")
                             <td>Action</td>
                             @endif
                          </tr>
                      </thead>
                      <tbody>

                        @foreach($allData as $key => $event)
                          <tr class="{{$event->id}}">
                            <td>{{$key+1}}</td>
                            <td>
                              <img  src="{{(!empty($event->image))?url('/upload/event_images/'.$event->image):url('/upload/d.png')}}" style="width: 40px; height: 50px; border: 1px solid #000;">
                            </td>
                            <td>{{$event->title}}</td>
                            <td>{{$event->description}}</td>
                            <td>{{date('Y-m-d',strtotime($event->date))}}</td>
                            @if(Auth::user()->role=="Admin")
                            <td>
                              <a title="Edit" class="btn btn-sm btn-primary" href="{{route('event.edit',$event->id)}}"><i class="fa fa-edit"></i></a>
                              <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{route('event.delete',$event->id)}}"><i class="fa fa-trash"></i></a>
                              
                            </td>
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