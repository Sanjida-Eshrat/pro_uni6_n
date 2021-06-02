@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Monthly Fee</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Fee</li>
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
                  Search Criteria
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                          <label> Department<font style="color:red"> *</font></label>
                            <select name="department_id" id="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}">{{$dept->name}}</option>
                              @endforeach
                            </select>
                    </div>
                   <div class="form-group col-md-3">
                          <label> Session<font style="color:red"> *</font></label>
                            <select name="session_id" id="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}">{{$session->name}}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-3">
                          <label> Month<font style="color:red"> *</font></label>
                            <select name="month" id="month" class="form-control form-control-sm">
                              <option value="">Select Month</option>
                              <option value="January">January</option>
                              <option value="February">February</option>
                              <option value="March">March</option>
                              <option value="April">April</option>
                              <option value="May">May</option>
                              <option value="June">June</option>
                              <option value="July">July</option>
                              <option value="August">August</option>
                              <option value="September">September</option>
                              <option value="October">October</option>
                              <option value="November">November</option>
                              <option value="December">December</option>
                            </select>
                    </div>
                    <div class="form-group col-md-3" style="padding-top: 30px;">
                      <a id="search" class="btn btn-info btn-sm" name="search" style="color:white">Search</a>
                    </div>
                  </div>
              </div>
              
              <div class="card-body">
              	<div id="DocumentResults"></div>
              	<script id="document-template" type="text/x-handlebars-template">
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
              	</script>
              </div>
            </div>  

            <!-- /.card -->  
             
          </section>


          <script type="text/javascript">
            $(document).on('click','#search',function(){
              var department_id =$('#department_id').val();
              var session_id = $('#session_id').val();
              $('.notifyjs-corner').html('');
              var month = $('#month').val();
              $('.notifyjs-corner').html('');

              if(department_id ==''){
                $.notify("Department required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              if(session_id ==''){
                $.notify("Session required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
               if(month ==''){
                $.notify("Month required", {globalPosition: 'top right',className: 'error'});
                return false;
              }
              $.ajax({
              	url: "{{route('students.monthly.fee.get-student')}}",
              	type: "get",
              	data: {'session_id':session_id,'department_id':department_id,'month':month},
              	beforeSend: function(){	
              	},
              	success: function (data){
              		var source = $("#document-template").html();
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