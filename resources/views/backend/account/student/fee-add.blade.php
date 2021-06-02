@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Students Fee</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Students Fee</li>
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
                   Add/Edit Students Fee
                   <a class="btn btn-success float-right btn-sm" href="{{route('accounts.fee.view')}}"><i class="fa fa-list"></i> Students Fee List</a>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="form-row">
                       <div class="form-group col-md-3">
                          <label for="session_id"> Session</label>
                            <select name="session_id" id="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}">{{$session->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="department_id"> Department</label>
                            <select name="department_id" id="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}">{{$dept->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                         <label for="fee_category_id">Fee Category</label>
                          <select name="fee_category_id" id="fee_category_id" class="form-control form-control-sm select2bs4">
                            <option value="">Select Fee Category</option>
                            @foreach($fee_categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                       <div class="form-group col-md-3">
                          <label> Date</label>
                            <input type="text" name="date" id="date"  class="form-control form-control-sm singledatepicker" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="form-group col-md-3">
                          <a id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                        </div>

                </div>
              </div><!-- /.card-body -->
              <div class="card-body">
                <div id="DocumentResults">
                    <script id="document-template" type="text/x-handlebars-template">
                      <form action="{{route('accounts.fee.store')}}" method="post">
                       @csrf
                        <table class="table-sm table-bordered table-striped" style="width: 100%">
                          <thead>
                            <tr>
                              @{{{thsource}}}
                            </tr>
                          </thead>
                          <tbody>
                            @{{#each this}}
                            <tr>
                              @{{{tdsource}}}
                            </tr>
                            @{{/each}}
                          </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px;">Submit</button>
                      </form>
                    </script>
                </div>
              </div>

           </div>  

            <!-- /.card -->
             
          </section>
          <script type="text/javascript">
            $(document).on('click','#search',function(){
              var session_id = $('#session_id').val();
              var department_id =$('#department_id').val();
              var fee_category_id =$('#fee_category_id').val();
              var date =$('#date').val();
              $('.notifyjs-corner').html('');

              if(session_id ==''){
                $.notify("Session required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              if(department_id ==''){
                $.notify("Department required", {globalPosition: 'top right',className: 'error'});
                return false;
              } 
              if(fee_category_id ==''){
                $.notify("Fee Category required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              if(date ==''){
                $.notify("Date required", {globalPosition: 'top right',className: 'error'});
                return false;
              }

               $.ajax({
                url: "{{route('accounts.fee.getstudent')}}",
                type: "get",
                data: {'session_id':session_id,'department_id':department_id,'fee_category_id':fee_category_id,'date':date},
                beforeSend:function(){  
                },
                success: function(data){
                  var source = $('#document-template').html();
                  var template = Handlebars.compile(source);
                  var html = template(data);
                  $('#DocumentResults').html(html);
                  $('[data-toggle="tooltip"]').tooltip();
                }
              });
            });
          </script>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


 <!-- /.content -->   
@endsection
