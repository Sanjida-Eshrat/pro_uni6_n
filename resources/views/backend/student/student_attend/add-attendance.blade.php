@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<link rel="stylesheet" type="text/css" href="
{{asset('backend/css/attend.css')}}">
<style type="text/css">
	.switch-toggle{
		width: auto;
	}
	.switch-toggle label:not(.disabled){
		cursor: pointer;
	}
	.switch-candy a{
		border: 1px solid #333;
		border-radius: 3px;
		box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(255,255,255,0.45);
		background-color: white;
		background-image: repeating-linear-gradient(top,rgba(255, 255, 255,0.2), transparent);
		background-image: linear-gradient(to bottom,rgba(255, 255, 255,0.2), transparent);
	}
	.switch-toggle.switch-candy, .switch-light.switch-candy  span{
		background-color: #5a6268;
		border-radius: 3px;
		box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
	} 

</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Student Attendance</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
          <li class="breadcrumb-item active">Student Attendance</li>
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
                    Edit Student Attendance
                    @else
                    Add Student Attendance
                    @endif
                   <a class="btn btn-success float-right btn-sm" href="{{route('students.attendance.view')}}"><i class="fa fa-plus-list"></i> Student Attendance List</a>
                </h3>
                
              </div><!-- /.card-header -->
             <!-- <div class="card-body">
                <form method="GET" action="{{route('students.search.attendance')}}" id="myForm">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                          <label> Department<font style="color:red"> *</font></label>
                            <select name="department_id" class="form-control form-control-sm">
                              <option value="">Select Department</option>
                              @foreach($departments as $dept)
                              <option value="{{$dept->id}}" {{(@$department_id==$dept->id)?"selected":""}}>{{$dept->name}}</option>
                              @endforeach
                            </select>
                    </div>
                   <div class="form-group col-md-4">
                          <label> Session<font style="color:red"> *</font></label>
                            <select name="session_id" class="form-control form-control-sm">
                              <option value="">Select Session</option>
                              @foreach($sessions as $session)
                              <option value="{{$session->id}}" {{(@$session_id==$session->id)?"selected":""}}>{{$session->name}}</option>
                              @endforeach
                            </select>
                    </div>
                     <div class="form-group col-md-4">
                          <label> Semester<font style="color:red"> *</font></label>
                            <select name="semester_id" class="form-control form-control-sm">
                              <option value="">Select Semester</option>
                              @foreach($semesters as $sem)
                              <option value="{{$sem->id}}" {{(@$semester_id==$sem->id)?"selected":""}}>{{$sem->name}}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-info btn-sm" name="search">Search</button>
                    </div>
                  </div>
                  
                </form>
               @if(@$search) 
              <form method="post" action="{{route('students.attendance.store')}}" id="myForm">
                @csrf
                @if(isset($editData))
                <div class="card-body">
                   <div class="form-group col-md-4">
                     <label class="control-label">Attendance date</label>
                     <input type="text" name="date" value="{{$editData['0']['date']}}" id="date" class="checkdate form-control form-control-sm" placeholder="Attendance Date" autocomplete="off" readonly>
                   </div>
                   <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                       <thead>
                          <tr>
                             <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                             <th rowspan="2" class="text-center" style="vertical-align: middle;">Student Name</th>
                             <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                          </tr>
                          <tr>
                             <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                             <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                             <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                          </tr>

                       </thead>
                       <tbody>
                         @foreach($editData as $key=> $data)
                         <tr id="div{{$data->id}}" class="text-center">
                          <input type="hidden" name="employee_id[]" value="{{$data->student_id}}" class="student_id">
                          <td>{{$key+1}}</td>
                          <td>{{$data['user']['name']}}</td>
                          <td colspan="3">
                            <div class="switch-toggle switch-3 switch-candy">
                              <input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" {{($data->attend_status=='Present')?'checked': ''}}>
                              <label for="present{{$key}}">Present</label>
                              <input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave" {{($data->attend_status=='Leave')?'checked': ''}}>
                              <label for="leave{{$key}}">Leave</label>
                              <input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent" {{($data->attend_status=='Absent')?'checked': ''}}>
                              <label for="absent{{$key}}">Absent</label>
                              <a></a>
                            </div>  
                          </td>
                         </tr>
                         @endforeach  
                       </tbody>
                   </table> <br>
                   <button type="submit" class="btn btn-success btn-sm">{{(@$editData) ? 'update' : 'submit'}}</button>  
                </div>
                @else
                <div class="card-body">
                   <div class="form-group col-md-4">
                     <label class="control-label">Attendance date</label>
                     <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendance Date" autocomplete="off">
                   </div>
                   <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                       <thead>
                          <tr>
                             <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                             <th rowspan="2" class="text-center" style="vertical-align: middle;">Student Name</th>
                             <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                          </tr>
                          <tr>
                             <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                             <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                             <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                          </tr>

                       </thead>
                       <tbody>
                         @foreach($students as $key=> $student)
                         <tr id="div{{$student->id}}" class="text-center">
                          <input type="hidden" name="student_id[]" value="{{$student->id}}" class="student_id">
                          <td>{{$key+1}}</td>
                          <td>{{$student->name}}</td>
                          <td colspan="3">
                            <div class="switch-toggle switch-3 switch-candy">
                              <input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" checked="checked">
                              <label for="present{{$key}}">Present</label>
                              <input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave" checked="checked">
                              <label for="leave{{$key}}">Leave</label>
                              <input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent" checked="checked">
                              <label for="absent{{$key}}">Absent</label>
                              <a></a>
                            </div>  
                          </td>
                         </tr>
                         @endforeach  
                       </tbody>
                   </table> <br>
                   <button type="submit" class="btn btn-success btn-sm">{{(@$editData) ? 'update' : 'submit'}}</button>  
                </div>
                @endif
              </form>
              @endif
              </div>-->
              <div class="card-body">
                <form method="post" action="{{route('students.attendance.store')}}" id="myForm">
                	@csrf
                  @if(isset($editData))
                  <div class="card-body">
                     <div class="form-group col-md-4">
                       <label class="control-label">Attendance date</label>
                       <input type="text" name="date" value="{{$editData['0']['date']}}" id="date" class="checkdate form-control form-control-sm" placeholder="Attendance Date" autocomplete="off" readonly>
                     </div>
                     <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                         <thead>
                            <tr>
                               <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                               <th rowspan="2" class="text-center" style="vertical-align: middle;">Student Name</th>
                               <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                            </tr>
                            <tr>
                               <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                               <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                               <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                            </tr>

                         </thead>
                         <tbody>
                           @foreach($editData as $key=> $data)
                           <tr id="div{{$data->id}}" class="text-center">
                            <input type="hidden" name="student_id[]" value="{{$data->student_id}}" class="student_id">
                            <td>{{$key+1}}</td>
                            <td>{{$data['user']['name']}}</td>
                            <td colspan="3">
                              <div class="switch-toggle switch-3 switch-candy">
                                <input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" {{($data->attend_status=='Present')?'checked': ''}}>
                                <label for="present{{$key}}">Present</label>
                                <input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave" {{($data->attend_status=='Leave')?'checked': ''}}>
                                <label for="leave{{$key}}">Leave</label>
                                <input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent" {{($data->attend_status=='Absent')?'checked': ''}}>
                                <label for="absent{{$key}}">Absent</label>
                                <a></a>
                              </div>  
                            </td>
                           </tr>
                           @endforeach  
                         </tbody>
                     </table> <br>
                     <button type="submit" class="btn btn-success btn-sm">{{(@$editData) ? 'update' : 'submit'}}</button>  
                  </div>
                  @else
                	<div class="card-body">
                	   <div class="form-group col-md-4">
                	   	 <label class="control-label">Attendance date</label>
                	   	 <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendance Date" autocomplete="off">
                	   </div>
                	   <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                	   	   <thead>
                	   	   	  <tr>
                	   	   	  	 <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                	   	   	  	 <th rowspan="2" class="text-center" style="vertical-align: middle;">Student Name</th>
                	   	   	  	 <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                	   	   	  </tr>
                	   	   	  <tr>
                	   	   	  	 <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                	   	   	  	 <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                	   	   	  	 <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                	   	   	  </tr>

                	   	   </thead>
                	   	   <tbody>
                	   	   	 @foreach($students as $key=> $student)
                	   	   	 <tr id="div{{$student->id}}" class="text-center">
                	   	   	 	<input type="hidden" name="student_id[]" value="{{$student->id}}" class="student_id">
                	   	   	 	<td>{{$key+1}}</td>
                	   	   	 	<td>{{$student->name}}</td>
                	   	   	 	<td colspan="3">
                	   	   	 		<div class="switch-toggle switch-3 switch-candy">
                	   	   	 			<input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" checked="checked">
                	   	   	 			<label for="present{{$key}}">Present</label>
                	   	   	 			<input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave" checked="checked">
                	   	   	 			<label for="leave{{$key}}">Leave</label>
                	   	   	 			<input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent" checked="checked">
                	   	   	 			<label for="absent{{$key}}">Absent</label>
                	   	   	 			<a></a>
                	   	   	 		</div>	
                	   	   	 	</td>
                	   	   	 </tr>
                	   	   	 @endforeach	
                	   	   </tbody>
                	   </table>	<br>
                	   <button type="submit" class="btn btn-success btn-sm">{{(@$editData) ? 'update' : 'submit'}}</button>  
                  </div>
                  @endif
                </form>
              </div>  
           <!--    
            </div>  

            <!-- /.card -->
            <script type="text/javascript">
              $(document).on('click','.present',function(){
                $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
              });
              $(document).on('click','.leave',function(){
                $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','white').css('color','#495057');
              });
              $(document).on('click','.absent',function(){
                $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
              });
            </script>
            <script type="text/javascript">
              $(document).on('click','.present_all',function(){
                $("input[value=Present]").prop('checked',true);
                $('.datetime').css('pointer-events','').css('background-color','#dee2e6').css('color','#495057');
              });
              $(document).on('click','.leave_all',function(){
                $("input[value=Leave]").prop('checked',true);
                $('.datetime').css('pointer-events','').css('background-color','white').css('color','#495057');
              });
              $(document).on('click','.absent_all',function(){
                $("input[value=Absent]").prop('checked',true);
                $('.datetime').css('pointer-events','').css('background-color','#dee2e6').css('color','#dee2e6');
              });
            </script>

            <script type="text/javascript">
            	$(document).ready(function(){
            		$('#myForm').validate({
            			rules:{
            				date: {
            					required: true,
            				}
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


