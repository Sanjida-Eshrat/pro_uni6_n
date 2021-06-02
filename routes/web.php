<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/                      

Route::get('/','Frontend\FrontendController@index')->name('frontend.home');
 //website pages
 Route::get('/events','Frontend\EventController@showEvent')->name('front-events.view');
 Route::get('/aboutus','Frontend\FrontendController@showAboutUs')->name('front-about-us.view'); 
 Route::get('/courses','Frontend\FrontendController@showCourse')->name('front-courses.view');
 Route::get('/faculty','Frontend\FrontendController@showFaculty')->name('front-faculty.view');
 Route::get('/contacts','Frontend\FrontendController@showContact')->name('front-contacts.view');
 Route::post('/contacts/store','Frontend\ContactController@storeMail')->name('contact.mail.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('backend.home');
Route::group(['middleware'=>'auth'],function(){

    Route::prefix('users')->group(function(){

		Route::get('/view','Backend\UserController@view')->name('users.view');
		Route::get('/add','Backend\UserController@add')->name('users.add');
		Route::post('/store','Backend\UserController@store')->name('users.store');
		Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
		Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
		Route::get('/delete/{id}','Backend\UserController@delete')->name('users.delete');
	 });

    Route::prefix('profiles')->group(function(){

		Route::get('/view','Backend\ProfileController@view')->name('profiles.view');
		Route::get('/edit','Backend\ProfileController@edit')->name('profiles.edit');
		Route::post('/store','Backend\ProfileController@update')->name('profiles.update');
		Route::get('/password/view','Backend\ProfileController@passwordView')->name('profiles.password.view');
		Route::post('/password/update','Backend\ProfileController@passwordUpdate')->name('profiles.password.update');

	});

	Route::prefix('setups')->group(function(){

		//Department routes
		Route::get('/department/view','Backend\Setup\DepartmentController@view')->name('setups.department.view');
		Route::get('/department/add','Backend\Setup\DepartmentController@add')->name('setups.department.add');
		Route::post('/department/store','Backend\Setup\DepartmentController@store')->name('setups.department.store');
		Route::get('/department/edit/{id}','Backend\Setup\DepartmentController@edit')->name('setups.department.edit');
		Route::post('/department/update/{id}','Backend\Setup\DepartmentController@update')->name('setups.department.update');
		Route::get('/department/delete/{id}','Backend\Setup\DepartmentController@delete')->name('setups.department.delete');

		//Session routes
		Route::get('/session/view','Backend\Setup\SessionController@view')->name('setups.session.view');
		Route::get('/session/add','Backend\Setup\SessionController@add')->name('setups.session.add');
		Route::post('/session/store','Backend\Setup\SessionController@store')->name('setups.session.store');
		Route::get('/session/edit/{id}','Backend\Setup\SessionController@edit')->name('setups.session.edit');
		Route::post('/session/update/{id}','Backend\Setup\SessionController@update')->name('setups.session.update');
		Route::get('/session/delete/{id}','Backend\Setup\SessionController@delete')->name('setups.session.delete');
		
		//Semester routes
		Route::get('/semester/view','Backend\Setup\SemesterController@view')->name('setups.semester.view');
		Route::get('/semester/add','Backend\Setup\SemesterController@add')->name('setups.semester.add');
		Route::post('/semester/store','Backend\Setup\SemesterController@store')->name('setups.semester.store');
		Route::get('/semester/edit/{id}','Backend\Setup\SemesterController@edit')->name('setups.semester.edit');
		Route::post('/semester/update/{id}','Backend\Setup\SemesterController@update')->name('setups.semester.update');
		Route::get('/semester/delete/{id}','Backend\Setup\SemesterController@delete')->name('setups.semester.delete');

		//Shift routes
		Route::get('/shift/view','Backend\Setup\ShiftController@view')->name('setups.shift.view');
		Route::get('/shift/add','Backend\Setup\ShiftController@add')->name('setups.shift.add');
		Route::post('/shift/store','Backend\Setup\ShiftController@store')->name('setups.shift.store');
		Route::get('/shift/edit/{id}','Backend\Setup\ShiftController@edit')->name('setups.shift.edit');
		Route::post('/shift/update/{id}','Backend\Setup\ShiftController@update')->name('setups.shift.update');
		Route::get('/shift/delete/{id}','Backend\Setup\ShiftController@delete')->name('setups.shift.delete');
		
		//Fee Category routes
		Route::get('/fee/category/view','Backend\Setup\FeeCategoryController@view')->name('setups.fee.category.view');
		Route::get('/fee/category/add','Backend\Setup\FeeCategoryController@add')->name('setups.fee.category.add');
		Route::post('/fee/category/store','Backend\Setup\FeeCategoryController@store')->name('setups.fee.category.store');
		Route::get('/fee/category/edit/{id}','Backend\Setup\FeeCategoryController@edit')->name('setups.fee.category.edit');
		Route::post('/fee/category/update/{id}','Backend\Setup\FeeCategoryController@update')->name('setups.fee.category.update');
		Route::get('/fee/category/delete/{id}','Backend\Setup\FeeCategoryController@delete')->name('setups.fee.category.delete');

		//Fee Category Amount routes
		Route::get('/fee/amount/view','Backend\Setup\FeeAmountController@view')->name('setups.fee.amount.view');
		Route::get('/fee/amount/add','Backend\Setup\FeeAmountController@add')->name('setups.fee.amount.add');
		Route::post('/fee/amount/store','Backend\Setup\FeeAmountController@store')->name('setups.fee.amount.store');
		Route::get('/fee/amount/edit/{fee_category_id}','Backend\Setup\FeeAmountController@edit')->name('setups.fee.amount.edit');
		Route::post('/fee/amount/update/{fee_category_id}','Backend\Setup\FeeAmountController@update')->name('setups.fee.amount.update');
		Route::post('/fee/amount/delete/{id}','Backend\Setup\FeeAmountController@delete')->name('setups.fee.amount.delete');
		Route::get('/fee/amount/details/{fee_category_id}','Backend\Setup\FeeAmountController@details')->name('setups.fee.amount.details');

		//Exam types routes
		Route::get('/exam/type/view','Backend\Setup\ExamTypeController@view')->name('setups.exam.type.view');
		Route::get('/exam/type/add','Backend\Setup\ExamTypeController@add')->name('setups.exam.type.add');
		Route::post('/exam/type/store','Backend\Setup\ExamTypeController@store')->name('setups.exam.type.store');
		Route::get('/exam/type/edit/{id}','Backend\Setup\ExamTypeController@edit')->name('setups.exam.type.edit');
		Route::post('/exam/type/update/{id}','Backend\Setup\ExamTypeController@update')->name('setups.exam.type.update');
		Route::get('/exam/type/delete/{id}','Backend\Setup\ExamTypeController@delete')->name('setups.exam.type.delete');

		//Subject routes
		Route::get('/subject/view','Backend\Setup\SubjectController@view')->name('setups.subject.view');
		Route::get('/subject/add','Backend\Setup\SubjectController@add')->name('setups.subject.add');
		Route::post('/subject/store','Backend\Setup\SubjectController@store')->name('setups.subject.store');
		Route::get('/subject/edit/{id}','Backend\Setup\SubjectController@edit')->name('setups.subject.edit');
		Route::post('/subject/update/{id}','Backend\Setup\SubjectController@update')->name('setups.subject.update');
		Route::get('/subject/delete/{id}','Backend\Setup\SubjectController@delete')->name('setups.subject.delete');

		//Assign Subject routes
		Route::get('/assign/subject/view','Backend\Setup\AssignSubjectController@view')->name('setups.assign.subject.view');
		Route::get('/assign/subject/add','Backend\Setup\AssignSubjectController@add')->name('setups.assign.subject.add');
		Route::post('/assign/subject/store','Backend\Setup\AssignSubjectController@store')->name('setups.assign.subject.store');
		Route::get('/assign/subject/edit/{department_id}','Backend\Setup\AssignSubjectController@edit')->name('setups.assign.subject.edit');
		Route::post('/assign/subject/update/{department_id}','Backend\Setup\AssignSubjectController@update')->name('setups.assign.subject.update');
		Route::get('/assign/subject/delete/{id}','Backend\Setup\AssignSubjectController@delete')->name('setups.assign.subject.delete');
		Route::get('/assign/subject/details/{department_id}','Backend\Setup\AssignSubjectController@details')->name('setups.assign.subject.details');

		//Designation routes
		Route::get('/designation/view','Backend\Setup\DesignationController@view')->name('setups.designation.view');
		Route::get('/designation/add','Backend\Setup\DesignationController@add')->name('setups.designation.add');
		Route::post('/designation/store','Backend\Setup\DesignationController@store')->name('setups.designation.store');
		Route::get('/designation/edit/{id}','Backend\Setup\DesignationController@edit')->name('setups.designation.edit');
		Route::post('/designation/update/{id}','Backend\Setup\DesignationController@update')->name('setups.designation.update');
		Route::get('/designation/delete/{id}','Backend\Setup\DesignationController@delete')->name('setups.designation.delete');

		//Teacher Designation routes
		Route::get('/teacher/designation/view','Backend\Setup\TeacherDesignationController@view')->name('setups.teacher.designation.view');
		Route::get('/teacher/designation/add','Backend\Setup\TeacherDesignationController@add')->name('setups.teacher.designation.add');
		Route::post('/teacher/designation/store','Backend\Setup\TeacherDesignationController@store')->name('setups.teacher.designation.store');
		Route::get('/teacher/designation/edit/{id}','Backend\Setup\TeacherDesignationController@edit')->name('setups.teacher.designation.edit');
		Route::post('/teacher/designation/update/{id}','Backend\Setup\TeacherDesignationController@update')->name('setups.teacher.designation.update');
		Route::get('/teacher/designation/delete/{id}','Backend\Setup\TeacherDesignationController@delete')->name('setups.teacher.designation.delete');
		
	});
	
	//Student Reg route
	Route::prefix('students')->group(function(){

		Route::get('/reg/view','Backend\Student\StudentRegController@view')->name('students.registration.view');
		Route::get('/reg/add','Backend\Student\StudentRegController@add')->name('students.registration.add');
		Route::post('/reg/store','Backend\Student\StudentRegController@store')->name('students.registration.store');
		Route::get('/reg/edit/{student_id}','Backend\Student\StudentRegController@edit')->name('students.registration.edit');
		Route::post('/reg/update/{student_id}','Backend\Student\StudentRegController@update')->name('students.registration.update');
		Route::get('/searchStudent','Backend\Student\StudentRegController@searchStudent')->name('students.search.student');
		Route::get('/reg/promotion/{student_id}','Backend\Student\StudentRegController@promotion')->name('students.registration.promotion');
		Route::post('/reg/promotion/{student_id}','Backend\Student\StudentRegController@promotionStore')->name('students.registration.promotion.store');
		//Route::get('/reg/details/{student_id}','Backend\Student\StudentRegController@details')->name('students.registration.details');
		Route::get('reg/details-n/{student_id}','Backend\Student\StudentRegController@details_n')->name('students.registration.details-n');
		//roll generate
		Route::get('/roll/view','Backend\Student\StudentRollController@view')->name('students.roll.view');
		Route::get('/roll/get-student','Backend\Student\StudentRollController@getStudent')->name('students.roll.get-student');
		Route::post('/roll/store','Backend\Student\StudentRollController@store')->name('students.roll.store');
		
		 //Student attendance
		Route::get('/attend/view','Backend\Student\StudentAttendanceController@view')->name('students.attendance.view');
		Route::get('/attend/add','Backend\Student\StudentAttendanceController@add')->name('students.attendance.add');
		Route::post('/attend/store','Backend\Student\StudentAttendanceController@store')->name('students.attendance.store');
		Route::get('/attend/edit/{date}','Backend\Student\StudentAttendanceController@edit')->name('students.attendance.edit');
		Route::get('/attend/details/{date}','Backend\Student\StudentAttendanceController@details')->name('students.attendance.details');
		Route::get('/attend/searchStudent','Backend\Student\StudentAttendanceController@searchStudent')->name('students.search.attendance');


		//Student Registration Fee
		Route::get('/reg/fee/view','Backend\Student\RegistrationFeeController@view')->name('students.reg.fee.view');
		Route::get('/reg/get-student','Backend\Student\RegistrationFeeController@getStudent')->name('students.reg.fee.get-student');
		Route::get('/reg/fee/payslip','Backend\Student\RegistrationFeeController@paySlip')->name('students.reg.fee.payslip');

		//Student Monthly Fee
		Route::get('/month/fee/view','Backend\Student\MonthlyFeeController@view')->name('students.monthly.fee.view');
		Route::get('/month/get-student','Backend\Student\MonthlyFeeController@getStudent')->name('students.monthly.fee.get-student');
		Route::get('/month/fee/payslip','Backend\Student\MonthlyFeeController@paySlip')->name('students.monthly.fee.payslip');

		//Student Exam Fee
		Route::get('/exam/fee/view','Backend\Student\ExamFeeController@view')->name('students.exam.fee.view');
		Route::get('/exam/get-student','Backend\Student\ExamFeeController@getStudent')->name('students.exam.fee.get-student');
		Route::get('/exam/fee/payslip','Backend\Student\ExamFeeController@paySlip')->name('students.exam.fee.payslip');

		
	});

	Route::prefix('employees')->group(function(){
	 	//Employee registration
		Route::get('/reg/view','Backend\Employee\EmployeeRegController@view')->name('employees.reg.view');
		Route::get('/reg/add','Backend\Employee\EmployeeRegController@add')->name('employees.reg.add');
		Route::post('/reg/store','Backend\Employee\EmployeeRegController@store')->name('employees.reg.store');
		Route::get('/reg/edit/{id}','Backend\Employee\EmployeeRegController@edit')->name('employees.reg.edit');
		Route::post('/reg/update/{id}','Backend\Employee\EmployeeRegController@update')->name('employees.reg.update');
		Route::get('/reg/delete/{id}','Backend\Employee\EmployeeRegController@delete')->name('employees.reg.delete');
		//Route::get('/reg/details/{id}','Backend\Employee\EmployeeRegController@details')->name('employees.reg.details');
		Route::get('reg/details-n/{id}','Backend\Employee\EmployeeRegController@details_n')->name('employees.reg.details-n');


		//Employee salary
		Route::get('/salary/view','Backend\Employee\EmployeeSalaryController@view')->name('employees.salary.view');
		Route::get('/salary/increment/{id}','Backend\Employee\EmployeeSalaryController@increment')->name('employees.salary.increment');
		Route::post('/salary/store/{id}','Backend\Employee\EmployeeSalaryController@store')->name('employees.salary.store');
		Route::get('/salary/details/{id}','Backend\Employee\EmployeeSalaryController@details')->name('employees.salary.details');
	 
	 	//Employee leave
		Route::get('/leave/view','Backend\Employee\EmployeeLeaveController@view')->name('employees.leave.view');
		Route::get('/leave/add','Backend\Employee\EmployeeLeaveController@add')->name('employees.leave.add');
		Route::post('/leave/store','Backend\Employee\EmployeeLeaveController@store')->name('employees.leave.store');
		Route::get('/leave/edit/{id}','Backend\Employee\EmployeeLeaveController@edit')->name('employees.leave.edit');
		Route::post('/leave/update/{id}','Backend\Employee\EmployeeLeaveController@update')->name('employees.leave.update');
		Route::get('/leave/delete/{id}','Backend\Employee\EmployeeLeaveController@delete')->name('employees.leave.delete');
		Route::get('/leave/details/{id}','Backend\Employee\EmployeeLeaveController@details')->name('employees.leave.details');

	    //Employee attendance
		Route::get('/attend/view','Backend\Employee\EmployeeAttendanceController@view')->name('employees.attendance.view');
		Route::get('/attend/add','Backend\Employee\EmployeeAttendanceController@add')->name('employees.attendance.add');
		Route::post('/attend/store','Backend\Employee\EmployeeAttendanceController@store')->name('employees.attendance.store');
		Route::get('/attend/edit/{date}','Backend\Employee\EmployeeAttendanceController@edit')->name('employees.attendance.edit');
		Route::get('/attend/details/{date}','Backend\Employee\EmployeeAttendanceController@details')->name('employees.attendance.details');

		//Employee Monthly Salary
		Route::get('/monthly/salary/view','Backend\Employee\MonthlySalaryController@view')->name('employees.monthly.salary.view');
		Route::get('/monthly/salary/get','Backend\Employee\MonthlySalaryController@getSalary')->name('employees.monthly.salary.get');
		Route::get('/monthly/salary/payslip/{employee_id}','Backend\Employee\MonthlySalaryController@paySlip')->name('employees.monthly.salary.payslip');
	});

    Route::prefix('teachers')->group(function(){
	 	//teacher registration
		Route::get('/reg/view','Backend\Teacher\TeacherRegController@view')->name('teachers.reg.view');
		Route::get('/reg/add','Backend\Teacher\TeacherRegController@add')->name('teachers.reg.add');
		Route::post('/reg/store','Backend\Teacher\TeacherRegController@store')->name('teachers.reg.store');
		Route::get('/reg/edit/{id}','Backend\Teacher\TeacherRegController@edit')->name('teachers.reg.edit');
		Route::post('/reg/update/{id}','Backend\Teacher\TeacherRegController@update')->name('teachers.reg.update');
		Route::get('/reg/delete/{id}','Backend\Teacher\TeacherRegController@delete')->name('teachers.reg.delete');
		//Route::get('/reg/details/{id}','Backend\Teacher\TeacherRegController@details')->name('teachers.reg.details');
		Route::get('reg/details-n/{id}','Backend\Teacher\TeacherRegController@details_n')->name('teachers.reg.details-n');


		//Teacher salary
		Route::get('/salary/view','Backend\Teacher\TeacherSalaryController@view')->name('teachers.salary.view');
		Route::get('/salary/increment/{id}','Backend\Teacher\TeacherSalaryController@increment')->name('teachers.salary.increment');
		Route::post('/salary/store/{id}','Backend\Teacher\TeacherSalaryController@store')->name('teachers.salary.store');
		Route::get('/salary/details/{id}','Backend\Teacher\TeacherSalaryController@details')->name('teachers.salary.details');
	 
	 	//Teacher leave
		Route::get('/leave/view','Backend\Teacher\TeacherLeaveController@view')->name('teachers.leave.view');
		Route::get('/leave/add','Backend\Teacher\TeacherLeaveController@add')->name('teachers.leave.add');
		Route::post('/leave/store','Backend\Teacher\TeacherLeaveController@store')->name('teachers.leave.store');
		Route::get('/leave/edit/{id}','Backend\Teacher\TeacherLeaveController@edit')->name('teachers.leave.edit');
		Route::post('/leave/update/{id}','Backend\Teacher\TeacherLeaveController@update')->name('teachers.leave.update');
		Route::get('/leave/delete/{id}','Backend\Teacher\TeacherLeaveController@delete')->name('teachers.leave.delete');
		Route::get('/leave/details/{id}','Backend\Teacher\TeacherLeaveController@details')->name('teachers.leave.details');

	    //Teacher attendance
		Route::get('/attend/view','Backend\Teacher\TeacherAttendanceController@view')->name('teachers.attendance.view');
		Route::get('/attend/add','Backend\Teacher\TeacherAttendanceController@add')->name('teachers.attendance.add');
		Route::post('/attend/store','Backend\Teacher\TeacherAttendanceController@store')->name('teachers.attendance.store');
		Route::get('/attend/edit/{date}','Backend\Teacher\TeacherAttendanceController@edit')->name('teachers.attendance.edit');
		Route::get('/attend/details/{date}','Backend\Teacher\TeacherAttendanceController@details')->name('teachers.attendance.details');

		//Teacher Monthly Salary
		Route::get('/monthly/salary/view','Backend\Teacher\MonthlySalaryController@view')->name('teachers.monthly.salary.view');
		Route::get('/monthly/salary/get','Backend\Teacher\MonthlySalaryController@getSalary')->name('teachers.monthly.salary.get');
		Route::get('/monthly/salary/payslip/{teacher_id}','Backend\Teacher\MonthlySalaryController@paySlip')->name('teachers.monthly.salary.payslip');
	});

	Route::prefix('accounts')->group(function(){
	 	//Student Fee
	 	Route::get('/student/fee/view','Backend\Account\StudentFeeController@view')->name('accounts.fee.view');
		Route::get('/student/fee/add','Backend\Account\StudentFeeController@add')->name('accounts.fee.add');
		Route::post('/student/fee/store','Backend\Account\StudentFeeController@store')->name('accounts.fee.store');
		Route::get('/student/fee/getstudent','Backend\Account\StudentFeeController@getStudent')->name('accounts.fee.getstudent');
 
		//Employee Salary
	 	Route::get('/employee/salary/view','Backend\Account\SalaryController@view')->name('accounts.salary.view');
		Route::get('/employee/salary/add','Backend\Account\SalaryController@add')->name('accounts.salary.add');
		Route::post('/employee/salary/store','Backend\Account\SalaryController@store')->name('accounts.salary.store');
		Route::get('/employee/salary/get-employee','Backend\Account\SalaryController@getEmployee')->name('accounts.salary.get-employee');

		//Teacher Salary
	 	Route::get('/teacher/salary/view','Backend\Account\TeacherSalaryController@view')->name('accounts.teacher.salary.view');
		Route::get('/teacher/salary/add','Backend\Account\TeacherSalaryController@add')->name('accounts.teacher.salary.add');
		Route::post('/teacher/salary/store','Backend\Account\TeacherSalaryController@store')->name('accounts.teacher.salary.store');
		Route::get('/teacher/salary/get-teacher','Backend\Account\TeacherSalaryController@getTeacher')->name('accounts.teacher.salary.get-teacher');

		//Other cost
		Route::get('/cost/view','Backend\Account\OtherCostController@view')->name('accounts.cost.view');
		Route::get('/cost/add','Backend\Account\OtherCostController@add')->name('accounts.cost.add');
		Route::post('/cost/store','Backend\Account\OtherCostController@store')->name('accounts.cost.store');
		Route::get('/cost/edit/{id}','Backend\Account\OtherCostController@edit')->name('accounts.cost.edit');
		Route::post('/cost/update/{id}','Backend\Account\OtherCostController@update')->name('accounts.cost.update');		
	 });

	Route::prefix('library')->group(function(){
	 	//Books Category
		Route::get('/book/category/view','Backend\Library\BookCategoryController@view')->name('library.book.category.view');
		Route::get('/book/category/add','Backend\Library\BookCategoryController@add')->name('library.book.category.add');
		Route::post('/book/category/store','Backend\Library\BookCategoryController@store')->name('library.book.category.store');
		Route::get('/book/category/edit/{id}','Backend\Library\BookCategoryController@edit')->name('library.book.category.edit');
		Route::post('/book/category/update/{id}','Backend\Library\BookCategoryController@update')->name('library.book.category.update');
		Route::post('/book/category/delete','Backend\Library\BookCategoryController@delete')->name('library.book.category.delete');

		//Books
		Route::get('/books/view','Backend\Library\BookController@view')->name('library.books.view');
		Route::get('/books/add','Backend\Library\BookController@add')->name('library.books.add');
		Route::post('/books/store','Backend\Library\BookController@store')->name('library.books.store');
		Route::get('/books/edit/{book_category_id}','Backend\Library\BookController@edit')->name('library.books.edit');
		Route::post('/books/update/{book_category_id}','Backend\Library\BookController@update')->name('library.books.update');
		Route::post('/books/delete','Backend\Library\BookController@delete')->name('library.books.delete');
		Route::get('/books/details/{book_category_id}','Backend\Library\BookController@details')->name('library.books.details');

		//Authors
		Route::get('/author/view','Backend\Library\AuthorController@view')->name('library.authors.view');
		Route::get('/author/add','Backend\Library\AuthorController@add')->name('library.authors.add');
		Route::post('/author/store','Backend\Library\AuthorController@store')->name('library.authors.store');
		Route::get('/author/edit/{id}','Backend\Library\AuthorController@edit')->name('library.authors.edit');
		Route::post('/author/update/{id}','Backend\Library\AuthorController@update')->name('library.authors.update');
		Route::post('/author/delete','Backend\Library\AuthorController@delete')->name('library.authors.delete');
		Route::get('/author/details/{id}','Backend\Library\AuthorController@details')->name('library.authors.details');

		//Member Students
		Route::get('/mem-students/view','Backend\Library\MemStudentController@view')->name('library.mem-students.view');
	});

	Route::prefix('frontend')->group(function(){

	 	//manage Logo
		Route::get('/logo/view','Frontend\LogoController@view')->name('logos.view');
		Route::get('/logo/add','Frontend\LogoController@add')->name('logos.add');
		Route::post('/logo/store','Frontend\LogoController@store')->name('logos.store');
		Route::get('/logo/edit/{id}','Frontend\LogoController@edit')->name('logos.edit');
		Route::post('/logo/update/{id}','Frontend\LogoController@update')->name('logos.update');
		Route::get('/logo/delete/{id}','Frontend\LogoController@delete')->name('logos.delete');

		//manage Slider
		Route::get('/slider/view','Frontend\SliderController@view')->name('sliders.view');
		Route::get('/slider/add','Frontend\SliderController@add')->name('sliders.add');
		Route::post('/slider/store','Frontend\SliderController@store')->name('sliders.store');
		Route::get('/slider/edit/{id}','Frontend\SliderController@edit')->name('sliders.edit');
		Route::post('/slider/update/{id}','Frontend\SliderController@update')->name('sliders.update');
		Route::get('/slider/delete/{id}','Frontend\SliderController@delete')->name('sliders.delete');

		//manage About Us
		Route::get('/about-us/view','Frontend\AboutUsController@view')->name('about-us.view');
		Route::get('/about-us/add','Frontend\AboutUsController@add')->name('about-us.add');
		Route::post('/about-us/store','Frontend\AboutUsController@store')->name('about-us.store');
		Route::get('/about-us/edit/{id}','Frontend\AboutUsController@edit')->name('about-us.edit');
		Route::post('/about-us/update/{id}','Frontend\AboutUsController@update')->name('about-us.update');
		Route::get('/about-us/delete/{id}','Frontend\AboutUsController@delete')->name('about-us.delete');

		//manage Course
		Route::get('/course/view','Frontend\CourseController@view')->name('courses.view');
		Route::get('/course/add','Frontend\CourseController@add')->name('courses.add');
		Route::post('/course/store','Frontend\CourseController@store')->name('courses.store');
		Route::get('/course/edit/{id}','Frontend\CourseController@edit')->name('courses.edit');
		Route::post('/course/update/{id}','Frontend\CourseController@update')->name('courses.update');
		Route::get('/course/delete/{id}','Frontend\CourseController@delete')->name('courses.delete');

		//manage Faculty Menber
		Route::get('/faculty/view','Frontend\FacultyController@view')->name('faculty.view');
		Route::get('/faculty/add','Frontend\FacultyController@add')->name('faculty.add');
		Route::post('/faculty/store','Frontend\FacultyController@store')->name('faculty.store');
		Route::get('/faculty/edit/{id}','Frontend\FacultyController@edit')->name('faculty.edit');
		Route::post('/faculty/update/{id}','Frontend\FacultyController@update')->name('faculty.update');
		Route::get('/faculty/delete/{id}','Frontend\FacultyController@delete')->name('faculty.delete');

		//manage Event
		Route::get('/event/view','Frontend\EventController@view')->name('event.view');
		Route::get('/event/add','Frontend\EventController@add')->name('event.add');
		Route::post('/event/store','Frontend\EventController@store')->name('event.store');
		Route::get('/event/edit/{id}','Frontend\EventController@edit')->name('event.edit');
		Route::post('/event/update/{id}','Frontend\EventController@update')->name('event.update');
		Route::get('/event/delete/{id}','Frontend\EventController@delete')->name('event.delete');

		//manage Why-Us
		Route::get('/why-us/view','Frontend\WhyUsController@view')->name('why-us.view');
		Route::get('/why-us/add','Frontend\WhyUsController@add')->name('why-us.add');
		Route::post('/why-us/store','Frontend\WhyUsController@store')->name('why-us.store');
		Route::get('/why-us/edit/{id}','Frontend\WhyUsController@edit')->name('why-us.edit');
		Route::post('/why-us/update/{id}','Frontend\WhyUsController@update')->name('why-us.update');
		Route::get('/why-us/delete/{id}','Frontend\WhyUsController@delete')->name('why-us.delete');

		//manage Testimonials
		Route::get('/testimonial/view','Frontend\TestimonialController@view')->name('testimonials.view');
		Route::get('/testimonial/add','Frontend\TestimonialController@add')->name('testimonials.add');
		Route::post('/testimonial/store','Frontend\TestimonialController@store')->name('testimonials.store');
		Route::get('/testimonial/edit/{id}','Frontend\TestimonialController@edit')->name('testimonials.edit');
		Route::post('/testimonial/update/{id}','Frontend\TestimonialController@update')->name('testimonials.update');
		Route::get('/testimonial/delete/{id}','Frontend\TestimonialController@delete')->name('testimonials.delete');

		//manage Contacts
		Route::get('/contact/view','Frontend\ContactController@view')->name('contacts.view');
		Route::get('/contact/add','Frontend\ContactController@add')->name('contacts.add');
		Route::post('/contact/store','Frontend\ContactController@store')->name('contacts.store');
		Route::get('/contact/edit/{id}','Frontend\ContactController@edit')->name('contacts.edit');
		Route::post('/contact/update/{id}','Frontend\ContactController@update')->name('contacts.update');
		Route::get('/contact/delete/{id}','Frontend\ContactController@delete')->name('contacts.delete');
	 
	});

	  
	
});
