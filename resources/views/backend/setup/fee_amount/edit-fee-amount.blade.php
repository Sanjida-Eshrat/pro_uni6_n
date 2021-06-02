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
                   Edit Fee Amount
                   <a class="btn btn-success float-right btn-sm" href="{{route('setups.fee.amount.view')}}"><i class="fa fa-list"></i>  Fee Amount List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('setups.fee.amount.update',$editData[0]->fee_category_id)}}" method="post" id="myForm" enctype="multipart/form-data">
                 @csrf
                  <div class="add_item">
                    <div class="form-row">
                      <div class="form-group col-md-5">
                        <label>Fee Category</label>
                        <select name="fee_category_id" class="form-control">
                          <option value="">Select Fee Category</option>
                          @foreach($fee_categories as $category)
                          <option value="{{$category->id}}" {{($editData['0']->fee_category_id==$category->id)?"selected":""}}>{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                     </div>
                    @foreach($editData as $edit) 
                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
	                    <div class="form-row">
	                      <div class="form-group col-md-4">
	                        <label>Department</label>
	                        <select name="department_id[]" class="form-control">
	                          <option value="">Select Department</option>
	                          @foreach($departments as $dept)
	                          <option value="{{$dept->id}}" {{($edit->department_id==$dept->id)?"selected":""}}>{{$dept->name}}</option>
	                          @endforeach
	                        </select>
	                      </div>
	                       <div class="form-group col-md-4">
	                        <label>Amount</label>
	                        <input type="text" name="amount[]" value="{{$edit->amount}}" class="form-control">
	                      </div>
	                      <div class="form-group col-md-4" style="padding-top: 30px;">
	                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"> </i></span>
	                        <span class="btn btn-danger removeeventmore"> <i class="fa fa-minus-circle"></i></span>
	                      </div>
	                    </div>
                    </div>
                    @endforeach              
                  </div>
                  <button type="submit" class="btn btn-primary">{{(@$editData)?'Update':'Submit'}}</button>   
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

<!-- extra_add_item -->
    <div style="visibility: hidden;">
      <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
          <div class="form-row">
            <div class="form-group col-md-5">
               <label>Department</label>
               <select name="department_id[]" class="form-control">
               <option value="">Select Department</option>
                @foreach($departments as $dept)
               <option value="{{$dept->id}}">{{$dept->name}}</option>
                @endforeach
               </select>
            </div>
            <div class="form-group col-md-5">
               <label>Amount</label>
               <input type="text" name="amount[]" class="form-control">
            </div>
            <div class="form-group col-md-5" style="padding-top: 30px;">
               <div class="form-row">
                  <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"> </i></span>
                   <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
               </div>        
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
         $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter-=1 
        });
      });
    </script>

 <script type="text/javascript">
$(document).ready(function () {
  
  $('#myForm').validate({
    rules: {
      "fee_category_id" : {
        required: true,  
      },
     "department_id[]": {
        required: true,
      },
      "amount[]": {
        required: true
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
    
    
@endsection
