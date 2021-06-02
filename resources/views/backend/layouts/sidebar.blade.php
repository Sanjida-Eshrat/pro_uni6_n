@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item ">
               <a href="{{ route('backend.home') }}" class="nav-link active">
                 <i class="nav-icon fas fa-tachometer-alt"></i>
                 <p>
                   Dashboard
                 
                 </p>
               </a>
             </li> 

          @if(Auth::user()->role=='Admin')       
          <li class="nav-item has-treeview {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-user nav-icon"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.view') }}" class="nav-link {{($route=='users.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.add') }}" class="nav-link {{($route=='users.add')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
             
            </ul>
          </li>
          @endif 

          <li class="nav-item has-treeview {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                 Profile Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profiles.view')}}" class="nav-link {{($route=='profiles.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Your Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('profiles.password.view')}}" class="nav-link {{($route=='profiles.password.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
             
            </ul>
          </li>

          @if(Auth::user()->role=='Admin') 
          <li class="nav-item has-treeview {{($prefix=='/setups')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Setup Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setups.department.view')}}" class="nav-link {{($route=='setups.department.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Departments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.session.view')}}" class="nav-link {{($route=='setups.session.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Sessions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.semester.view')}}" class="nav-link {{($route=='setups.semester.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Semesters</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.shift.view')}}" class="nav-link {{($route=='setups.shift.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Shift</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.fee.category.view')}}" class="nav-link {{($route=='setups.fee.category.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Fee Category</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('setups.fee.amount.view')}}" class="nav-link {{($route=='setups.fee.amount.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Fee Category Amount</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.exam.type.view')}}" class="nav-link {{($route=='setups.exam.type.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Exam Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.subject.view')}}" class="nav-link {{($route=='setups.subject.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Subjects</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="{{route('setups.assign.subject.view')}}" class="nav-link {{($route=='setups.assign.subject.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subjects</p>
                </a>
              </li> -->
               <li class="nav-item">
                <a href="{{route('setups.designation.view')}}" class="nav-link {{($route=='setups.designation.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Designation</p>
                </a>
              </li>
             
            </ul>
          </li> 
          @endif
          @if(Auth::user()->role=='Admin') 
          <li class="nav-item has-treeview {{($prefix=='/students')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Student Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.registration.view')}}" class="nav-link {{($route=='students.registration.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Student Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.roll.view')}}" class="nav-link {{($route=='students.roll.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Roll Generate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.attendance.view')}}" class="nav-link {{($route=='students.attendance.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.reg.fee.view')}}" class="nav-link {{($route=='students.reg.fee.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Registration Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.monthly.fee.view')}}" class="nav-link {{($route=='students.monthly.fee.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Monthly Fee</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('students.exam.fee.view')}}" class="nav-link {{($route=='students.exam.fee.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Exam Fee</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role=='Admin') 
          <li class="nav-item has-treeview {{($prefix=='/teacherss')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Teacher Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('teachers.reg.view')}}" class="nav-link {{($route=='teachers.reg.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Teacher Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('teachers.salary.view')}}" class="nav-link {{($route=='teachers.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Teacher salary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('teachers.leave.view')}}" class="nav-link {{($route=='teachers.leave.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Teacher Leave</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('teachers.attendance.view')}}" class="nav-link {{($route=='teachers.attendance.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Teacher Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('teachers.monthly.salary.view')}}" class="nav-link {{($route=='teachers.monthly.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Monthly Salary</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role=='Admin') 
          <li class="nav-item has-treeview {{($prefix=='/employees')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Employee Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employees.reg.view')}}" class="nav-link {{($route=='employees.reg.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Employee Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.salary.view')}}" class="nav-link {{($route=='employees.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Employee salary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.leave.view')}}" class="nav-link {{($route=='employees.leave.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Employee Leave</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.attendance.view')}}" class="nav-link {{($route=='employees.attendance.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Employee Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.monthly.salary.view')}}" class="nav-link {{($route=='employees.monthly.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Monthly Salary</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role=='Admin') 
          <li class="nav-item has-treeview {{($prefix=='/accounts')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Accounts Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('accounts.fee.view')}}" class="nav-link {{($route=='accounts.fee.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Students Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('accounts.salary.view')}}" class="nav-link {{($route=='accounts.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Employee Salary</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('accounts.teacher.salary.view')}}" class="nav-link {{($route=='accounts.teacher.salary.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Teacher Salary</p>
                </a>
              </li>
          <!--    <li class="nav-item">
                <a href="{{route('accounts.cost.view')}}" class="nav-link {{($route=='accounts.cost.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Other Cost</p>
                </a>
              </li> --> 
            </ul>
          </li>
          @endif

       <!--   <li class="nav-item has-treeview {{($prefix=='/library')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-square nav-icon"></i>
              <p>
                Library Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('library.book.category.view')}}" class="nav-link {{($route=='library.book.category.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Book Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('library.books.view')}}" class="nav-link {{($route=='library.books.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Books</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('library.authors.view')}}" class="nav-link {{($route=='library.authors.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Authors</p>
                </a>
              </li>
              <li class="nav-item has-treeview
                {{($prefix=='/library')?'menu-open':''}}">
                <a href="#" class="nav-link copy">
                  <i class="far fa-square nav-icon"></i>
                  <p>
                    Members
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                     <a href="{{route('library.mem-students.view')}}" class="nav-link {{($route=='library.mem-students.view')?'active':''}}">
                       <i class="far fa-square nav-icon"></i>
                       <p>Students</p>
                     </a>
                   </li> 
                    <li class="nav-item">
                     <a href="{{route('library.books.view')}}" class="nav-link {{($route=='library.books.view')?'active':''}}">
                       <i class="far fa-square nav-icon"></i>
                       <p>Employees</p>
                     </a>
                   </li>    
                </ul>
              </li>
            </ul>
          </li> -->

          @if(Auth::user()->role=='Admin')       
          <li class="nav-item has-treeview {{($prefix=='/frontend')?'menu-open':''}}">
            <a href="#" class="nav-link copy">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Frontend Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('logos.view') }}" class="nav-link {{($route=='logos.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Logos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sliders.view') }}" class="nav-link {{($route=='sliders.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('courses.view') }}" class="nav-link {{($route=='courses.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('faculty.view') }}" class="nav-link {{($route=='faculty.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Faculty Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('about-us.view') }}" class="nav-link {{($route=='about-us.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>About Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('event.view') }}" class="nav-link {{($route=='event.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('why-us.view') }}" class="nav-link {{($route=='why-us.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Why Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('testimonials.view') }}" class="nav-link {{($route=='testimonials.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Testimonial</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('contacts.view') }}" class="nav-link {{($route=='contacts.view')?'active':''}}">
                  <i class="far fa-square nav-icon"></i>
                  <p>Contact</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->usertype=='student')
       <!--   <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
             <a href="{{route('students.registration.view')}}" class="nav-link {{($route=='students.registration.view')?'active':''}}">
               <i class="far fa-circle nav-icon"></i>
                <p>Student Registration</p>
              </a>
          </li>
           <li class="nav-item">
                <a href="{{ route('event.view') }}" class="nav-link {{($route=='event.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Event</p>
                </a>
              </li>
          @endif 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->