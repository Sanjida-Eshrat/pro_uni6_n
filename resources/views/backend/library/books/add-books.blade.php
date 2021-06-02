@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Books</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Books</li>
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
                   Add Book
                   <a class="btn btn-success float-right btn-sm" href="{{route('library.books.view')}}"><i class="fa fa-list"></i>  Book List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="{{route('library.books.store')}}" id="myForm" enctype="multipart/form-data">
                 @csrf
                  <div class="add_item">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Book Category</label>
                        <select name="book_category_id[]" class="form-control">
                          <option value="">Select Book Category</option>
                          @foreach($book_categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                          </select> 
                      </div>                      
                     </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Author</label>
                        <select name="author_id[]" class="form-control">
                          <option value="">Select Author</option>
                          @foreach($authors as $author)
                          <option value="{{$author->id}}">{{$author->name}}</option>
                          @endforeach
                        <option value="0">New Author</option>
                          </select> 
                          <input type="text" name="name" class="form-control form-control-sm" placeholder="Write Author Name" id="add_others" style="display: none ">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Book Title</label>
                        <input type="text" name="bookTitle[]" class="form-control">
                      </div>
                      <div class="form-group col-md-2">
                        <label>Edition</label>
                        <input type="text" name="edition[]" class="form-control">
                      </div>
                      <div class="form-group col-md-2">
                        <label>Available Copies</label>
                        <input type="text" name="booksAvail[]" class="form-control">
                      </div>
                      <div class="form-group col-md-1" style="padding-top: 30px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                      </div>
                    </div>               
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
              <div class="form-group col-md-4">
                 <label>Author</label>
                 <select name="author_id[]" class="form-control">
                    <option value="">Select Author</option>
                    @foreach($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                     @endforeach
                    <option value="0">New Author</option>
                 </select> 
                 <input type="text" name="name" class="form-control form-control-sm" placeholder="Write Author Name" id="add_others" style="display: none ">
                 </div>   
              <div class="form-group col-md-4">
                  <label>Book Title</label>
                  <input type="text" name="bookTitle[]" class="form-control">
               </div>
               <div class="form-group col-md-2">
                   <label>Edition</label>
                      <input type="text" name="edition[]" class="form-control">
                </div>
                 <div class="form-group col-md-2">
                    <label>Available Copies</label>
                      <input type="text" name="booksAvail[]" class="form-control">
                  </div>
            <div class="form-group col-md-1" style="padding-top: 30px;">
               <div class="form-row">
                  <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"> </i></span>
                   <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
               </div>        
            </div>
          </div>
        </div>
      </div>
    </div>


<!--    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('change','#author_id',function(){
          var author_id=$(this).val();
          if(author_id=='0'){
            $('#add_others').show();
          }
          else{
            $('#add_others').hide();
          }
        });
      });
    </script> -->
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
      "book_category_id" : {
        required: true,  
      },
     "author_id[]": {
        required: true,
      },
      "bookTitle[]": {
        required: true
      },
      "edition[]": {
        required: true
      },
      "booksAvail[]": {
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
