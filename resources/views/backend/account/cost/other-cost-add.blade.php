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
                	@if(isset($editData))
                    Edit Cost
                    @else
                    Add Cost
                    @endif
                   <a class="btn btn-success float-right btn-sm" href="{{route('accounts.cost.view')}}"><i class="fa fa-list"></i> Other Cost List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                  <form action="{{(@$editData)?route('accounts.cost.update',$editData->id):route('accounts.cost.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                   
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label> Date</label>
                            <input type="text" name="date" value="{{@$editData->date}}" class="form-control form-control-sm singledatepicker" placeholder="Date">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Amount</label><input type="text" name="amount" value="{{@$editData->amount}}" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-3">
                          <label> Image</label>
                          <input type="file" name="image" class="form-control form-control-sm" id="image">  
                        </div>
                        <div class="form-group col-md-4">
                          <img id="showImage" src="{{(!empty($editData->image))?url('/upload/cost_images/'.$editData->image):url('/upload/d.png')}}" style="width: 250px; height: 100px; border: 1px solid #000;">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Description</label>
                          <textarea name="description" class="form-control" rows="4">{{@$editData->description}}</textarea>
                        </div>
                        <div class="form-group col-md-3">
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
    <script type="text/javascript">
		$(document).ready(function () {
		  
		  $('#myForm').validate({
		    rules: {
		      date: {
		        required: true,
		      },
		       amount: {
		        required: true,
		      },
		       description: {
		        required: true,
		      },
		    },
		    messages: {
		    
		    },
		    errorElement: 'span',
		    errorPlacement: function (error, element) {
		      error.addClass('invalid-feedback');
		      element.closest('.form-group').append(error);
		    },
		    highlight: function (element, errorClass, validClass) {
		      $(element).addClass('is-invalid');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		      $(element).removeClass('is-invalid');
		    }
		  });
		});
</script>


 <!-- /.content -->   
@endsection
