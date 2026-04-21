<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('app');
// });
// Route::view('/', 'app');
Route::view('/{path?}', 'app');
// Route::get('/{path?}', function () {
//     return view('app');
// })->where('path', '.*');

Route::prefix('admin')->group(function () {
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.post');
    Route::get('/logout', 'AdminLoginController@logout')->name('admin.logout');
});





Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {


    //Dashboard

    Route::get('dashboard', 'DashboardController@index')
    ->middleware('check.permission:view-dashboard')
    ->name('admin.dashboard');

    //Profile,Password


    Route::get('/profile', 'AdminLoginController@profile')->name('admin.profile');
    Route::post('/change_profile', 'AdminController@changeProfile')->name('admin.changeProfile.post');
    Route::post('/change_password', 'AdminController@changePassword')->name('admin.changePassword.post');


    //Academic Information

    // Route::resource('classes', 'ClassController')->middleware('check.permission:manage-classes,admin');
    // Route::resource('subjects', 'SubjectController')->middleware('check.permission:manage-subjects,admin');
    // Route::resource('branches', 'BranchController');
    // Route::resource('batches', 'BatchController');
    // Route::get('active_batches', 'BatchController@activeBatch')->name('admin.activeBatch');

    Route::resource('classes', 'ClassController')
        ->middleware('check.permission:manage-classes');
    
    Route::resource('subjects', 'SubjectController')
        ->middleware('check.permission:manage-subjects');
    
    Route::resource('branches', 'BranchController')
        ->middleware('check.permission:manage-branches');
    
    Route::resource('batches', 'BatchController')
        ->middleware('check.permission:manage-batches');
    
    Route::get('active_batches', 'BatchController@activeBatch')
        ->middleware('check.permission:manage-batches')
        ->name('admin.activeBatch');


    
    //Homework

    // Route::get('homework', 'AdminHomeworkController@index')->name('admin.homework');
    // Route::get('pdf_homework/{id}', 'AdminHomeworkController@pdfHomework')->name('admin.pdfHomework');
    // Route::get('evaluate_homework/{id}', 'AdminHomeworkController@evaluateHomework')->name('admin.evaluateHomework');
    // Route::post('evaluate_homework/{id}', 'AdminHomeworkController@evaluateHomeworkScore')->name('admin.evaluateHomework');

    Route::get('homework', 'AdminHomeworkController@index')
        ->middleware('check.permission:view-homework')
        ->name('admin.homework');
    
    Route::get('pdf_homework/{id}', 'AdminHomeworkController@pdfHomework')
        ->middleware('check.permission:view-homework')
        ->name('admin.pdfHomework');
    
    Route::get('evaluate_homework/{id}', 'AdminHomeworkController@evaluateHomework')
        ->middleware('check.permission:evaluate-homework')
        ->name('admin.evaluateHomework');
    
    Route::post('evaluate_homework/{id}', 'AdminHomeworkController@evaluateHomeworkScore')
        ->middleware('check.permission:evaluate-homework')
        ->name('admin.evaluateHomework');


    //Zoom Classes


    // Route::get('/meetings', 'ZoomClass@list')->name('admin.zoom');
    // Route::get('/add_meetings', 'ZoomClass@add');
    // Route::post('/meetings', 'ZoomClass@create');
    // Route::post('/change_status_id', 'ZoomClass@changeStatus');
    // Route::get('/meetings/{id}', 'ZoomClass@get')->where('id', '[0-9]+');
    // Route::get('/meetings/delete/{id}', 'ZoomClass@delete');

    // Route::get('/edit_meeting/{id}', 'ZoomClass@edit');
    // Route::patch('/meetings/{id}', 'ZoomClass@update')->where('id', '[0-9]+');



    // Route::get('/meetings/participants/{id}', 'ZoomClass@participant_list');
    // Route::post('/meetings/submit_attendance', 'ZoomClass@submit_attendance');
    // Route::get('/meetings/attendance/{id}', 'ZoomClass@attendance_list');

// Zoom Classes
    Route::middleware('check.permission:manage-zoom-classes')->group(function () {
        Route::get('/meetings', 'ZoomClass@list')->name('admin.zoom');
        Route::get('/add_meetings', 'ZoomClass@add');
        Route::post('/meetings', 'ZoomClass@create');
        Route::post('/change_status_id', 'ZoomClass@changeStatus');
        Route::get('/meetings/{id}', 'ZoomClass@get')->where('id', '[0-9]+');
        Route::get('/meetings/delete/{id}', 'ZoomClass@delete');
        Route::get('/edit_meeting/{id}', 'ZoomClass@edit');
        Route::patch('/meetings/{id}', 'ZoomClass@update')->where('id', '[0-9]+');
    });

    // Attendance
    Route::get('/meetings/participants/{id}', 'ZoomClass@participant_list')
        ->middleware('check.permission:view-attendance');
    
    Route::get('/meetings/attendance/{id}', 'ZoomClass@attendance_list')
        ->middleware('check.permission:view-attendance');
    
    Route::post('/meetings/submit_attendance', 'ZoomClass@submit_attendance')
        ->middleware('check.permission:submit-attendance');




    //Different User
    
    Route::resource('admins', 'AdminController')->middleware('check.permission:view-admins');
    
       // Admin Management
    // Route::middleware('check.permission:view-admins')->group(function () {
    //     Route::get('admins', 'AdminController@index')->name('admins.index');
    //     Route::get('admins/{admin}', 'AdminController@show')->name('admins.show');
    // });
    
    // Route::get('admins/create', 'AdminController@create')->middleware('check.permission:create-admins')
    //     ->name('admins.create');
    
    // Route::post('admins', 'AdminController@store')->middleware('check.permission:create-admins')
    //     ->name('admins.store');
    
    // Route::get('admins/{admin}/edit', 'AdminController@edit') ->middleware('check.permission:edit-admins')
    //     ->name('admins.edit');
    
    // Route::put('admins/{admin}', 'AdminController@update')->middleware('check.permission:edit-admins')
    //     ->name('admins.update');
    
    // Route::patch('admins/{admin}', 'AdminController@update') ->middleware('check.permission:edit-admins');
    
    // Route::delete('admins/{admin}', 'AdminController@destroy')->middleware('check.permission:delete-admins')
    //     ->name('admins.destroy');


    Route::resource('teachers', 'TeacherController')->middleware('check.permission:view-teachers');
    Route::get('teachers_payment_installment/{id}', 'TeacherController@paymentInstallmentList')
            ->middleware('check.permission:view-teachers')->name('teachers.paymentInstallmentList');
    // Route::get('add_teachers_payment_installment/{id}', 'TeacherController@addTeacherPaymentInstallment')
    //     ->middleware('check.permission:manage-teacher-payments')
    //     ->name('teachers.addTeacherPaymentInstallment');
    // Route::post('create_teachers_payment_installment/{id}', 'TeacherController@createTeacherPaymentInstallment')
    //     ->middleware('check.permission:manage-teacher-payments')
    //     ->name('teachers.createTeacherPaymentInstallment');

    // Teachers
    // Route::middleware('check.permission:view-teachers')->group(function () {
    //     Route::get('teachers', 'TeacherController@index')->name('teachers.index');
    //     Route::get('teachers/{teacher}', 'TeacherController@show')->name('teachers.show');
    //     Route::get('teachers_payment_installment/{id}', 'TeacherController@paymentInstallmentList')
    //         ->name('teachers.paymentInstallmentList');
    // });
    
    // Route::get('teachers/create', 'TeacherController@create')
    //     ->middleware('check.permission:create-teachers')
    //     ->name('teachers.create');
    
    // Route::post('teachers', 'TeacherController@store')
    //     ->middleware('check.permission:create-teachers')
    //     ->name('teachers.store');
    
    // Route::get('teachers/{teacher}/edit', 'TeacherController@edit')
    //     ->middleware('check.permission:edit-teachers')
    //     ->name('teachers.edit');
    
    // Route::put('teachers/{teacher}', 'TeacherController@update')
    //     ->middleware('check.permission:edit-teachers')
    //     ->name('teachers.update');
    
    // Route::patch('teachers/{teacher}', 'TeacherController@update')
    //     ->middleware('check.permission:edit-teachers');
    
    // Route::delete('teachers/{teacher}', 'TeacherController@destroy')
    //     ->middleware('check.permission:delete-teachers')
    //     ->name('teachers.destroy');

     Route::middleware('check.permission:manage-teacher-payments')->group(function () {
        Route::get('add_teachers_payment_installment/{id}', 'TeacherController@addTeacherPaymentInstallment')
            ->name('teachers.addTeacherPaymentInstallment');
        Route::post('create_teachers_payment_installment/{id}', 'TeacherController@createTeacherPaymentInstallment')
            ->name('teachers.createTeacherPaymentInstallment');
    });


    Route::get('/test-permissions', function() {
        $adminRole = Role::where('name', 'Admin')
                        ->where('guard_name', 'admin')
                        ->first();
        
        if ($adminRole) {
            $hasPermission = $adminRole->hasPermissionTo('view-admins', 'admin');
            
            dd([
                'role' => $adminRole->name,
                'has_view_admins' => $hasPermission,
                'all_permissions' => $adminRole->permissions->pluck('name')->toArray()
            ]);
        }
    });


    // Route::get('/students', 'AdminStudentController@list')->name('admin.students');
    // Route::get('/students_search', 'AdminStudentController@listSearch');
    // Route::get('/students_search_pdf', 'AdminStudentController@listSearchPdf');


    // Route::get('/student_view/{id}', 'AdminStudentController@viewStudent')->name('admin.student_view');
    // Route::get('/student_delete/{id}', 'AdminStudentController@deleteStudent')->name('admin.student_delete');

    // Students
    Route::middleware('check.permission:view-students')->group(function () {
        Route::get('/students', 'AdminStudentController@list')->name('admin.students');
        Route::get('/students_search', 'AdminStudentController@listSearch');
        Route::get('/students_search_pdf', 'AdminStudentController@listSearchPdf');
        Route::get('/student_view/{id}', 'AdminStudentController@viewStudent')->name('admin.student_view');
    });
    
    Route::get('/student_delete/{id}', 'AdminStudentController@deleteStudent')
        ->middleware('check.permission:delete-students')
        ->name('admin.student_delete');



    // Route::get('/student_view_payment/{id}', 'AdminStudentController@viewStudentpayment')->name('admin.student_view_payment');

    // Route::get('/student_change_due_date/{id}', 'AdminStudentController@changeDueDate')->name('admin.student_change_due_date');

    // Route::post('/student_due_date_update', 'AdminStudentController@updateDueDate')->name('admin.student_change_due_update');


    Route::middleware('check.permission:view-student-payments')->group(function () {
        Route::get('/student_view_payment/{id}', 'AdminStudentController@viewStudentpayment')
            ->name('admin.student_view_payment');
        Route::get('/student_change_due_date/{id}', 'AdminStudentController@changeDueDate')
            ->name('admin.student_change_due_date');
        Route::post('/student_due_date_update', 'AdminStudentController@updateDueDate')
            ->name('admin.student_change_due_update');
    });


    //Student payments
    
       
    // Route::get('/student_payments', 'AdminStudentPaymentController@list')->name('admin.student_payments');

    // Route::get('/approved_online_student_payments', 'AdminStudentPaymentController@approvedOnlinelist')->name('admin.online_approved_payments');
    // Route::get('/pending_online_student_payments', 'AdminStudentPaymentController@pendingOnlineList')->name('admin.online_pending_payments');
    
    // Route::get('/online_student_payment_approval/{id}', 'AdminStudentPaymentController@onlinePaymentApproval')->name('admin.student_online_payment_approval');
    // Route::post('/online_student_payment_approval_create', 'AdminStudentPaymentController@onlinePaymentApprovalCreate')->name('admin.student_online_payment_approval_create');


    // Student Payments
    Route::middleware('check.permission:view-payments')->group(function () {
        Route::get('/student_payments', 'AdminStudentPaymentController@list')
            ->name('admin.student_payments');
        Route::get('/approved_online_student_payments', 'AdminStudentPaymentController@approvedOnlinelist')
            ->name('admin.online_approved_payments');
        Route::get('/pending_online_student_payments', 'AdminStudentPaymentController@pendingOnlineList')
            ->name('admin.online_pending_payments');
    });
    Route::middleware('check.permission:approve-online-payments')->group(function () {
        Route::get('/online_student_payment_approval/{id}', 'AdminStudentPaymentController@onlinePaymentApproval')
            ->name('admin.student_online_payment_approval');
        Route::post('/online_student_payment_approval_create', 'AdminStudentPaymentController@onlinePaymentApprovalCreate')
            ->name('admin.student_online_payment_approval_create');
    });

    //Online Student

    // Route::get('/online_students', 'AdminOnlineStudentController@list')->name('admin.online_students');

    // Route::get('/online_students_search', 'AdminOnlineStudentController@listSearch');
    // Route::get('/online_students_search_pdf', 'AdminOnlineStudentController@listSearchPdf');
    

    // Route::delete('/online_student_delete/{id}', 'AdminOnlineStudentController@delete')->name('admin.online_student_delete');
    // Route::get('/online_student_registration_pdf/{id}', 'AdminOnlineStudentController@online_student_registration_pdf')->name('admin.online_student_registration_pdf');

     
      Route::middleware('check.permission:view-online-students')->group(function () {
        Route::get('/online_students', 'AdminOnlineStudentController@list')->name('admin.online_students');
        Route::get('/online_students_search', 'AdminOnlineStudentController@listSearch');
        Route::get('/online_students_search_pdf', 'AdminOnlineStudentController@listSearchPdf');
        Route::get('/online_student_registration_pdf/{id}', 'AdminOnlineStudentController@online_student_registration_pdf')
            ->name('admin.online_student_registration_pdf');
    });


    //Offline Student
    // Route::get('/offline_students', 'AdminOfflineStudentController@list')->name('admin.offline_students');

    // Route::get('/offline_students_search', 'AdminOfflineStudentController@listSearch');
    // Route::get('/offline_students_search_pdf', 'AdminOfflineStudentController@listSearchPdf');
    

    // Route::get('/add_offline_student', 'AdminOfflineStudentController@add_student')->name('admin.add_offline_student');
    // Route::post('/create_offline_student', 'AdminOfflineStudentController@create_student')->name('admin.create_offline_student');

    // Route::get('/offline_student/edit/{id}', 'AdminOfflineStudentController@edit_student')->name('admin.edit_offline_student');
    // Route::post('/update_offline_student/{id}', 'AdminOfflineStudentController@update_offline_student')->name('admin.update_offline_student');

    

    // Route::get('/offline_payments/{id}', 'AdminOfflineStudentController@offline_payments')->name('admin.offline_payments');
    
    // Route::get('/add_offline_student_course/{id}', 'AdminOfflineStudentController@add_student_course')->name('admin.add_offline_student_course');


    // Route::post('/create_offline_student_course/{id}', 'AdminOfflineStudentController@create_offline_student_course')->name('admin.create_offline_student_course');

    // Route::get('/offline_payments/installments/{id}', 'AdminOfflineStudentController@offline_payment_installments')->name('admin.offline_payment_installments');

    // Route::get('/offline_payments/add_installment/{id}', 'AdminOfflineStudentController@add_offline_payment_installment')->name('admin.add_offline_payment_installment');

    // Route::post('/offline_payments/create_installment/{id}', 'AdminOfflineStudentController@create_offline_payment_installment')->name('admin.create_offline_payment_installment');

    // Route::get('/offline_student_payments', 'AdminOfflineStudentController@offline_payment_list')->name('admin.offline_payment_list');

    // Route::get('/offline_student_registration_pdf/{id}', 'AdminOfflineStudentController@offline_student_registration_pdf')->name('admin.offline_student_registration_pdf');


    // Route::get('/offline_payments/installments/edit/{id}', 'AdminOfflineStudentController@edit_offline_payment_installment')->name('admin.edit_offline_payment_installment');

    // Route::post('/offline_payments/update_installment/{id}', 'AdminOfflineStudentController@update_offline_payment_installment')->name('admin.update_offline_payment_installment');


    // Route::get('/offline_payment_invoice/{id}', 'AdminOfflineStudentController@offline_payment_invoice')->name('admin.offline_payment_invoice');

    // Route::get('/offline_due_sms', 'AdminOfflineStudentController@offline_due_sms')->name('admin.offline_due_sms');
    
    // Route::get('/offline_student_admit_pdf/{id}', 'AdminOfflineStudentController@offline_student_admit_pdf')->name('admin.offline_student_admit_pdf');


          


   
    // Offline Students
    Route::middleware('check.permission:view-offline-students')->group(function () {
        Route::get('/offline_students', 'AdminOfflineStudentController@list')->name('admin.offline_students');
        Route::get('/offline_students_search', 'AdminOfflineStudentController@listSearch');
        Route::get('/offline_students_search_pdf', 'AdminOfflineStudentController@listSearchPdf');
        Route::get('/offline_student_registration_pdf/{id}', 'AdminOfflineStudentController@offline_student_registration_pdf')
            ->name('admin.offline_student_registration_pdf');
        Route::get('/offline_student_admit_pdf/{id}', 'AdminOfflineStudentController@offline_student_admit_pdf')
            ->name('admin.offline_student_admit_pdf');
    });

    Route::middleware('check.permission:create-offline-students')->group(function () {
        Route::get('/add_offline_student', 'AdminOfflineStudentController@add_student')
            ->name('admin.add_offline_student');
        Route::post('/create_offline_student', 'AdminOfflineStudentController@create_student')
            ->name('admin.create_offline_student');
        Route::get('/add_offline_student_course/{id}', 'AdminOfflineStudentController@add_student_course')
            ->name('admin.add_offline_student_course');
        Route::post('/create_offline_student_course/{id}', 'AdminOfflineStudentController@create_offline_student_course')
            ->name('admin.create_offline_student_course');
    });

     Route::middleware('check.permission:edit-offline-students')->group(function () {
        Route::get('/offline_student/edit/{id}', 'AdminOfflineStudentController@edit_student')
            ->name('admin.edit_offline_student');
        Route::post('/update_offline_student/{id}', 'AdminOfflineStudentController@update_offline_student')
            ->name('admin.update_offline_student');
    });


    Route::middleware('check.permission:manage-offline-payments')->group(function () {
        Route::get('/offline_payments/{id}', 'AdminOfflineStudentController@offline_payments')
            ->name('admin.offline_payments');
        Route::get('/offline_payments/installments/{id}', 'AdminOfflineStudentController@offline_payment_installments')
            ->name('admin.offline_payment_installments');
        Route::get('/offline_payments/add_installment/{id}', 'AdminOfflineStudentController@add_offline_payment_installment')
            ->name('admin.add_offline_payment_installment');
        Route::post('/offline_payments/create_installment/{id}', 'AdminOfflineStudentController@create_offline_payment_installment')
            ->name('admin.create_offline_payment_installment');
        Route::get('/offline_student_payments', 'AdminOfflineStudentController@offline_payment_list')
            ->name('admin.offline_payment_list');
        Route::get('/offline_payments/installments/edit/{id}', 'AdminOfflineStudentController@edit_offline_payment_installment')
            ->name('admin.edit_offline_payment_installment');
        Route::post('/offline_payments/update_installment/{id}', 'AdminOfflineStudentController@update_offline_payment_installment')
            ->name('admin.update_offline_payment_installment');
        Route::get('/offline_payment_invoice/{id}', 'AdminOfflineStudentController@offline_payment_invoice')
            ->name('admin.offline_payment_invoice');
    });

     Route::get('/offline_due_sms', 'AdminOfflineStudentController@offline_due_sms')
        ->middleware('check.permission:send-due-sms')
        ->name('admin.offline_due_sms');

    //Mcq Exam

    
    // Route::get('/mcq_exams', 'AdminMCQExamController@exam_list')->name('admin.mcqExamList');
    // Route::get('/add_mcq_exam', 'AdminMCQExamController@add_mcq_exam')->name('admin.addMcqExam');
    // Route::post('/create_mcq_exam', 'AdminMCQExamController@create_mcq_exam')->name('admin.createMcqExam');

    // Route::get('/duplicate_mcq_exam/{id}', 'AdminMCQExamController@duplicate_mcq_exam')->name('admin.duplicateMcqExam');
    
    // Route::post('/change_mcq_exam_status', 'AdminMCQExamController@changeStatus')->name('admin.changeMcqExamStatus');

    // Route::post('/change_mcq_result_publish_status', 'AdminMCQExamController@changeResultPublishStatus')->name('admin.changeMcqExamResultPublishStatus');
    
    // Route::get('/edit_mcq_exam/{id}', 'AdminMCQExamController@edit_mcq_exam')->name('admin.editMcqExam');
    // Route::post('/update_mcq_exam/{id}', 'AdminMCQExamController@update_mcq_exam')->name('admin.updateMcqExam');
    // Route::get('/delete_mcq_exam/{id}', 'AdminMCQExamController@delete_mcq_exam')->name('admin.deleteMcqExam');
    // Route::get('/add_mcq_question/{id}', 'AdminMCQExamController@add_mcq_question')->name('admin.addMcqQuestion');
    // Route::post('/create_mcq_question', 'AdminMCQExamController@create_mcq_question')->name('admin.createMcqQuestion');
    // Route::get('/view_mcq_question/{id}', 'AdminMCQExamController@view_mcq_question')->name('admin. viewMcqQuestion');
    // Route::get('/edit_mcq_question/{id}', 'AdminMCQExamController@edit_mcq_question')->name('admin.editMcqQuestion');
    // Route::post('/update_mcq_question/{id}', 'AdminMCQExamController@update_mcq_question')->name('admin.updateMcqQuestion');
    // Route::get('/delete_mcq_question/{id}', 'AdminMCQExamController@delete_mcq_question')->name('admin.deleteMcqQuestion');
    // Route::post('/upload_mcq_image', 'AdminMCQExamController@upload_mcq_image')->name('admin.uploadMcqImage');

    
    // Route::get('/mcq_exam_result', 'AdminMCQExamController@mcq_exam_result')->name('admin.mcqExamResult');
    // Route::get('/mcq_exam_result/{id}', 'AdminMCQExamController@mcq_exam_result_view')->name('admin.mcqExamResultView');
    // Route::get('/mcq_student_result/{exam_id}/student/{student_id}', 'AdminMCQExamController@mcq_student_result')->name('admin.mcqStudentResult');


    // //Cq Exam


    // Route::get('/cq_exams', 'AdminCQExamController@exam_list')->name('admin.cqExamList');
    // Route::get('/add_cq_exam', 'AdminCQExamController@add_cq_exam')->name('admin.addCqExam');
    // Route::post('/create_cq_exam', 'AdminCQExamController@create_cq_exam')->name('admin.createCqExam');
    // Route::post('/change_cq_exam_status', 'AdminCQExamController@change_cq_exam_status')->name('admin.changeCqExamStatus');
    // Route::get('/edit_cq_exam/{id}', 'AdminCQExamController@edit_cq_exam')->name('admin.editCqExam');
    // Route::post('/update_cq_exam/{id}', 'AdminCQExamController@update_cq_exam')->name('admin.updateCqExam');
    // Route::get('/delete_cq_exam/{id}', 'AdminCQExamController@delete_cq_exam')->name('admin.deleteCqExam');
    // Route::get('/add_cq_question/{id}', 'AdminCQExamController@add_cq_question')->name('admin.addCqQuestion');

    // Route::post('/upload_cq_image', 'AdminCQExamController@upload_cq_image')->name('admin.uploadCqImage');

    // Route::post('/create_cq_question', 'AdminCQExamController@create_cq_question')->name('admin.createCqQuestion');
    // Route::get('/view_cq_question/{id}', 'AdminCQExamController@view_cq_question')->name('admin. viewCqQuestion');
    // Route::get('/edit_cq_question/{id}', 'AdminCQExamController@edit_cq_question')->name('admin.editCqQuestion');
    // Route::post('/update_cq_question/{id}', 'AdminCQExamController@update_cq_question')->name('admin.updateCqQuestion');
    // Route::get('/delete_cq_question/{id}', 'AdminCQExamController@delete_cq_question')->name('admin.deleteCqQuestion');


    // Route::get('/cq_exam_result', 'AdminCQExamController@cq_exam_result')->name('admin.cqExamResult');
    // Route::get('/cq_exam_result/{id}', 'AdminCQExamController@cq_exam_result_view')->name('admin.cqExamResultView');
    // Route::get('/cq_student_answer/{exam_id}/student/{student_id}', 'AdminCQExamController@pdfStudentAnswer')->name('admin.pdfStudentAnswer');

    // Route::get('/cq_student_marking/{exam_id}/student/{student_id}', 'AdminCQExamController@studentMarking')->name('admin.studentMarking');

    // Route::post('/cq_exam_marking_update', 'AdminCQExamController@studentMarkingUpdate')->name('admin.studentMarkingUpdate');

    // Route::get('/cq_add_solve_sheet/{id}', 'AdminCQExamController@add_solve_sheet')->name('admin.add_solve_sheet');

    // Route::post('/cq_post_solve_sheet/{id}', 'AdminCQExamController@post_solve_sheet')->name('admin.post_solve_sheet');
    // Route::get('/solve_download/{path}', 'AdminCQExamController@solve_download');

    // Route::post('/change_cq_rank_publish_status', 'AdminCQExamController@changeRankPublishStatus')->name('admin.changeMcqExamrankPublishStatus');


     // MCQ Exams
    Route::middleware('check.permission:manage-mcq-exams')->group(function () {
        Route::get('/mcq_exams', 'AdminMCQExamController@exam_list')->name('admin.mcqExamList');
        Route::get('/add_mcq_exam', 'AdminMCQExamController@add_mcq_exam')->name('admin.addMcqExam');
        Route::post('/create_mcq_exam', 'AdminMCQExamController@create_mcq_exam')->name('admin.createMcqExam');
        Route::get('/duplicate_mcq_exam/{id}', 'AdminMCQExamController@duplicate_mcq_exam')->name('admin.duplicateMcqExam');
        Route::post('/change_mcq_exam_status', 'AdminMCQExamController@changeStatus')->name('admin.changeMcqExamStatus');
        Route::post('/change_mcq_result_publish_status', 'AdminMCQExamController@changeResultPublishStatus')
            ->name('admin.changeMcqExamResultPublishStatus');
        Route::get('/edit_mcq_exam/{id}', 'AdminMCQExamController@edit_mcq_exam')->name('admin.editMcqExam');
        Route::post('/update_mcq_exam/{id}', 'AdminMCQExamController@update_mcq_exam')->name('admin.updateMcqExam');
        Route::get('/delete_mcq_exam/{id}', 'AdminMCQExamController@delete_mcq_exam')->name('admin.deleteMcqExam');
        Route::get('/add_mcq_question/{id}', 'AdminMCQExamController@add_mcq_question')->name('admin.addMcqQuestion');
        Route::post('/create_mcq_question', 'AdminMCQExamController@create_mcq_question')->name('admin.createMcqQuestion');
        Route::get('/view_mcq_question/{id}', 'AdminMCQExamController@view_mcq_question')->name('admin. viewMcqQuestion');
        Route::get('/edit_mcq_question/{id}', 'AdminMCQExamController@edit_mcq_question')->name('admin.editMcqQuestion');
        Route::post('/update_mcq_question/{id}', 'AdminMCQExamController@update_mcq_question')->name('admin.updateMcqQuestion');
        Route::get('/delete_mcq_question/{id}', 'AdminMCQExamController@delete_mcq_question')->name('admin.deleteMcqQuestion');
        Route::post('/upload_mcq_image', 'AdminMCQExamController@upload_mcq_image')->name('admin.uploadMcqImage');
    });
    
    Route::middleware('check.permission:view-mcq-results')->group(function () {
        Route::get('/mcq_exam_result', 'AdminMCQExamController@mcq_exam_result')->name('admin.mcqExamResult');
        Route::get('/mcq_exam_result/{id}', 'AdminMCQExamController@mcq_exam_result_view')->name('admin.mcqExamResultView');
        Route::get('/mcq_student_result/{exam_id}/student/{student_id}', 'AdminMCQExamController@mcq_student_result')
            ->name('admin.mcqStudentResult');
    });

    // CQ Exams
    Route::middleware('check.permission:manage-cq-exams')->group(function () {
        Route::get('/cq_exams', 'AdminCQExamController@exam_list')->name('admin.cqExamList');
        Route::get('/add_cq_exam', 'AdminCQExamController@add_cq_exam')->name('admin.addCqExam');
        Route::post('/create_cq_exam', 'AdminCQExamController@create_cq_exam')->name('admin.createCqExam');
        Route::post('/change_cq_exam_status', 'AdminCQExamController@change_cq_exam_status')->name('admin.changeCqExamStatus');
        Route::get('/edit_cq_exam/{id}', 'AdminCQExamController@edit_cq_exam')->name('admin.editCqExam');
        Route::post('/update_cq_exam/{id}', 'AdminCQExamController@update_cq_exam')->name('admin.updateCqExam');
        Route::get('/delete_cq_exam/{id}', 'AdminCQExamController@delete_cq_exam')->name('admin.deleteCqExam');
        Route::get('/add_cq_question/{id}', 'AdminCQExamController@add_cq_question')->name('admin.addCqQuestion');
        Route::post('/upload_cq_image', 'AdminCQExamController@upload_cq_image')->name('admin.uploadCqImage');
        Route::post('/create_cq_question', 'AdminCQExamController@create_cq_question')->name('admin.createCqQuestion');
        Route::get('/view_cq_question/{id}', 'AdminCQExamController@view_cq_question')->name('admin. viewCqQuestion');
        Route::get('/edit_cq_question/{id}', 'AdminCQExamController@edit_cq_question')->name('admin.editCqQuestion');
        Route::post('/update_cq_question/{id}', 'AdminCQExamController@update_cq_question')->name('admin.updateCqQuestion');
        Route::get('/delete_cq_question/{id}', 'AdminCQExamController@delete_cq_question')->name('admin.deleteCqQuestion');
        Route::get('/cq_add_solve_sheet/{id}', 'AdminCQExamController@add_solve_sheet')->name('admin.add_solve_sheet');
        Route::post('/cq_post_solve_sheet/{id}', 'AdminCQExamController@post_solve_sheet')->name('admin.post_solve_sheet');
        Route::get('/solve_download/{path}', 'AdminCQExamController@solve_download');
        Route::post('/change_cq_rank_publish_status', 'AdminCQExamController@changeRankPublishStatus')
            ->name('admin.changeMcqExamrankPublishStatus');
    });
    
    Route::middleware('check.permission:view-cq-results')->group(function () {
        Route::get('/cq_exam_result', 'AdminCQExamController@cq_exam_result')->name('admin.cqExamResult');
        Route::get('/cq_exam_result/{id}', 'AdminCQExamController@cq_exam_result_view')->name('admin.cqExamResultView');
        Route::get('/cq_student_answer/{exam_id}/student/{student_id}', 'AdminCQExamController@pdfStudentAnswer')
            ->name('admin.pdfStudentAnswer');
    });
    
    Route::middleware('check.permission:evaluate-cq-exams')->group(function () {
        Route::get('/cq_student_marking/{exam_id}/student/{student_id}', 'AdminCQExamController@studentMarking')
            ->name('admin.studentMarking');
        Route::post('/cq_exam_marking_update', 'AdminCQExamController@studentMarkingUpdate')
            ->name('admin.studentMarkingUpdate');
    });


    

    
    // //Company Details

    // Route::get('/company', 'CompanyDetailController@create')->name('admin.companyDetail');
    // Route::post('/company', 'CompanyDetailController@store')->name('admin.companyDetail.store');
    // Route::post('/company/update/{id}', 'CompanyDetailController@update')->name('admin.companyDetail.update');

       

    // Route::resource('/zoomApis', 'ZoomApiController');
     


    // Route::get('/instruction', 'InstructionController@create')->name('admin.instruction');
    // Route::post('/instruction/update/{id}', 'InstructionController@update')->name('admin.instruction.update');


     // MCQ Exams
    Route::middleware('check.permission:manage-mcq-exams')->group(function () {
        Route::get('/mcq_exams', 'AdminMCQExamController@exam_list')->name('admin.mcqExamList');
        Route::get('/add_mcq_exam', 'AdminMCQExamController@add_mcq_exam')->name('admin.addMcqExam');
        Route::post('/create_mcq_exam', 'AdminMCQExamController@create_mcq_exam')->name('admin.createMcqExam');
        Route::get('/duplicate_mcq_exam/{id}', 'AdminMCQExamController@duplicate_mcq_exam')->name('admin.duplicateMcqExam');
        Route::post('/change_mcq_exam_status', 'AdminMCQExamController@changeStatus')->name('admin.changeMcqExamStatus');
        Route::post('/change_mcq_result_publish_status', 'AdminMCQExamController@changeResultPublishStatus')
            ->name('admin.changeMcqExamResultPublishStatus');
        Route::get('/edit_mcq_exam/{id}', 'AdminMCQExamController@edit_mcq_exam')->name('admin.editMcqExam');
        Route::post('/update_mcq_exam/{id}', 'AdminMCQExamController@update_mcq_exam')->name('admin.updateMcqExam');
        Route::get('/delete_mcq_exam/{id}', 'AdminMCQExamController@delete_mcq_exam')->name('admin.deleteMcqExam');
        Route::get('/add_mcq_question/{id}', 'AdminMCQExamController@add_mcq_question')->name('admin.addMcqQuestion');
        Route::post('/create_mcq_question', 'AdminMCQExamController@create_mcq_question')->name('admin.createMcqQuestion');
        Route::get('/view_mcq_question/{id}', 'AdminMCQExamController@view_mcq_question')->name('admin. viewMcqQuestion');
        Route::get('/edit_mcq_question/{id}', 'AdminMCQExamController@edit_mcq_question')->name('admin.editMcqQuestion');
        Route::post('/update_mcq_question/{id}', 'AdminMCQExamController@update_mcq_question')->name('admin.updateMcqQuestion');
        Route::get('/delete_mcq_question/{id}', 'AdminMCQExamController@delete_mcq_question')->name('admin.deleteMcqQuestion');
        Route::post('/upload_mcq_image', 'AdminMCQExamController@upload_mcq_image')->name('admin.uploadMcqImage');
    });
    
    Route::middleware('check.permission:view-mcq-results')->group(function () {
        Route::get('/mcq_exam_result', 'AdminMCQExamController@mcq_exam_result')->name('admin.mcqExamResult');
        Route::get('/mcq_exam_result/{id}', 'AdminMCQExamController@mcq_exam_result_view')->name('admin.mcqExamResultView');
        Route::get('/mcq_student_result/{exam_id}/student/{student_id}', 'AdminMCQExamController@mcq_student_result')
            ->name('admin.mcqStudentResult');
    });

    // CQ Exams
    Route::middleware('check.permission:manage-cq-exams')->group(function () {
        Route::get('/cq_exams', 'AdminCQExamController@exam_list')->name('admin.cqExamList');
        Route::get('/add_cq_exam', 'AdminCQExamController@add_cq_exam')->name('admin.addCqExam');
        Route::post('/create_cq_exam', 'AdminCQExamController@create_cq_exam')->name('admin.createCqExam');
        Route::post('/change_cq_exam_status', 'AdminCQExamController@change_cq_exam_status')->name('admin.changeCqExamStatus');
        Route::get('/edit_cq_exam/{id}', 'AdminCQExamController@edit_cq_exam')->name('admin.editCqExam');
        Route::post('/update_cq_exam/{id}', 'AdminCQExamController@update_cq_exam')->name('admin.updateCqExam');
        Route::get('/delete_cq_exam/{id}', 'AdminCQExamController@delete_cq_exam')->name('admin.deleteCqExam');
        Route::get('/add_cq_question/{id}', 'AdminCQExamController@add_cq_question')->name('admin.addCqQuestion');
        Route::post('/upload_cq_image', 'AdminCQExamController@upload_cq_image')->name('admin.uploadCqImage');
        Route::post('/create_cq_question', 'AdminCQExamController@create_cq_question')->name('admin.createCqQuestion');
        Route::get('/view_cq_question/{id}', 'AdminCQExamController@view_cq_question')->name('admin. viewCqQuestion');
        Route::get('/edit_cq_question/{id}', 'AdminCQExamController@edit_cq_question')->name('admin.editCqQuestion');
        Route::post('/update_cq_question/{id}', 'AdminCQExamController@update_cq_question')->name('admin.updateCqQuestion');
        Route::get('/delete_cq_question/{id}', 'AdminCQExamController@delete_cq_question')->name('admin.deleteCqQuestion');
        Route::get('/cq_add_solve_sheet/{id}', 'AdminCQExamController@add_solve_sheet')->name('admin.add_solve_sheet');
        Route::post('/cq_post_solve_sheet/{id}', 'AdminCQExamController@post_solve_sheet')->name('admin.post_solve_sheet');
        Route::get('/solve_download/{path}', 'AdminCQExamController@solve_download');
        Route::post('/change_cq_rank_publish_status', 'AdminCQExamController@changeRankPublishStatus')
            ->name('admin.changeMcqExamrankPublishStatus');
    });
    
    Route::middleware('check.permission:view-cq-results')->group(function () {
        Route::get('/cq_exam_result', 'AdminCQExamController@cq_exam_result')->name('admin.cqExamResult');
        Route::get('/cq_exam_result/{id}', 'AdminCQExamController@cq_exam_result_view')->name('admin.cqExamResultView');
        Route::get('/cq_student_answer/{exam_id}/student/{student_id}', 'AdminCQExamController@pdfStudentAnswer')
            ->name('admin.pdfStudentAnswer');
    });
    
    Route::middleware('check.permission:evaluate-cq-exams')->group(function () {
        Route::get('/cq_student_marking/{exam_id}/student/{student_id}', 'AdminCQExamController@studentMarking')
            ->name('admin.studentMarking');
        Route::post('/cq_exam_marking_update', 'AdminCQExamController@studentMarkingUpdate')
            ->name('admin.studentMarkingUpdate');
    });

     // Company Details
    Route::middleware('check.permission:manage-company-details')->group(function () {
        Route::get('/company', 'CompanyDetailController@create')->name('admin.companyDetail');
        Route::post('/company', 'CompanyDetailController@store')->name('admin.companyDetail.store');
        Route::post('/company/update/{id}', 'CompanyDetailController@update')->name('admin.companyDetail.update');
    });

    // Zoom API
    Route::resource('/zoomApis', 'ZoomApiController')
        ->middleware('check.permission:manage-zoom-api');

    // Instructions
    Route::middleware('check.permission:manage-instructions')->group(function () {
        Route::get('/instruction', 'InstructionController@create')->name('admin.instruction');
        Route::post('/instruction/update/{id}', 'InstructionController@update')->name('admin.instruction.update');
    });

    //Upload content type

    // Route::resource('upload_content_types', 'UploadContentTypeController');


    // //Content Upload
    // Route::resource('contents', 'AdminContentController');
    // Route::get('/content_download/{path}', 'AdminContentController@content_download');
    // Route::get('/content_view/{id}', 'AdminContentController@content_view');
    // //Lecture Sheet Upload
    // Route::resource('lecture_sheets', 'AdminLectureSheetController');
    // Route::get('/lecture_download/{path}', 'AdminLectureSheetController@lecture_download');
    // Route::get('/lecture_view/{id}', 'AdminLectureSheetController@lecture_view');

    // Content Management
    Route::resource('upload_content_types', 'UploadContentTypeController')
        ->middleware('check.permission:manage-contents');
    
    Route::middleware('check.permission:manage-contents')->group(function () {
        Route::resource('contents', 'AdminContentController');
        Route::get('/content_download/{path}', 'AdminContentController@content_download');
        Route::get('/content_view/{id}', 'AdminContentController@content_view');
    });
    
    Route::middleware('check.permission:manage-lecture-sheets')->group(function () {
        Route::resource('lecture_sheets', 'AdminLectureSheetController');
        Route::get('/lecture_download/{path}', 'AdminLectureSheetController@lecture_download');
        Route::get('/lecture_view/{id}', 'AdminLectureSheetController@lecture_view');
    });


    //Role management


    Route::resource('roles', 'RoleController')->middleware('check.permission:manage-roles');
    Route::get('roles/{id}/permissions', 'RoleController@managePermissions')->middleware('check.permission:manage-roles')->name('roles.permissions');
    Route::post('roles/{id}/permissions', 'RoleController@updatePermissions')->middleware('check.permission:manage-roles')->name('roles.permissions.update');


    //Expense Head

    Route::resource('expense_heads', 'ExpenseHeadController')->middleware('check.permission:manage-expense-heads');

    //Expense

    Route::resource('expenses', 'ExpenseController')->middleware('check.permission:view-expenses');
    Route::get('/expense_pdf', 'ExpenseController@expensePdf')->middleware('check.permission:view-expenses');

    Route::get('/expense_search', 'ExpenseController@expenseSearch')->middleware('check.permission:view-expenses');
    Route::get('/expense_search_pdf', 'ExpenseController@expensePdfSearch')->middleware('check.permission:view-expenses');


    // Route::middleware('check.permission:view-expenses')->group(function () {
    //     Route::get('expenses', 'ExpenseController@index')->name('expenses.index');
    //     Route::get('expenses/{expense}', 'ExpenseController@show')->name('expenses.show');
    //     Route::get('/expense_pdf', 'ExpenseController@expensePdf');
    //     Route::get('/expense_search', 'ExpenseController@expenseSearch');
    //     Route::get('/expense_search_pdf', 'ExpenseController@expensePdfSearch');
    // });
    
    // Route::get('expenses/create', 'ExpenseController@create')
    //     ->middleware('check.permission:create-expenses')
    //     ->name('expenses.create');
    
    // Route::post('expenses', 'ExpenseController@store')
    //     ->middleware('check.permission:create-expenses')
    //     ->name('expenses.store');
    
    // Route::get('expenses/{expense}/edit', 'ExpenseController@edit')
    //     ->middleware('check.permission:edit-expenses')
    //     ->name('expenses.edit');
    
    // Route::put('expenses/{expense}', 'ExpenseController@update')
    //     ->middleware('check.permission:edit-expenses')
    //     ->name('expenses.update');
    
    // Route::patch('expenses/{expense}', 'ExpenseController@update')
    //     ->middleware('check.permission:edit-expenses');
    
    // Route::delete('expenses/{expense}', 'ExpenseController@destroy')
    //     ->middleware('check.permission:delete-expenses')
    //     ->name('expenses.destroy');
    
   //Expense category

    Route::resource('expenseCategory', 'ExpenseCategoryController')->middleware('check.permission:manage-expense-categories');


    //Communication
    Route::resource('messages', 'AdminMessageController')->middleware('check.permission:send-messages');;
    Route::resource('sms', 'AdminSMSController')->middleware('check.permission:send-sms');
    Route::resource('dueSms', 'AdminDueSMSController')->middleware('check.permission:send-due-sms');

    // Route::get('/expense_report', 'ReportController@expenseReport')->name('expense.report');
    // Route::get('/expense_report_search', 'ReportController@expenseSearch')->name('expense.search');


     Route::middleware('check.permission:view-expense-reports')->group(function () {
        Route::get('/expense_report', 'ReportController@expenseReport')->name('expense.report');
        Route::get('/expense_report_search', 'ReportController@expenseSearch')->name('expense.search');
    });

    //Exam Result Upload & SMS

    // Route::get('/exams', 'AdminExamController@exam_list')->name('admin.examList');
    // Route::get('/add_exam', 'AdminExamController@add_exam')->name('admin.addExam');
    // Route::post('/create_exam', 'AdminExamController@create_exam')->name('admin.createExam');
    // Route::get('/exam_result/{id}', 'AdminExamController@exam_result')->name('admin.examResult');
    // Route::get('/individul_exam_result_list/{id}', 'AdminExamController@individual_std_exam_result_list')->name('admin.individualStdExamResult');
    // Route::get('/individul_exam_result_search/{id}', 'AdminExamController@individual_std_exam_result_search')->name('admin.individualStdExamResultSearch');
    // Route::get('/individul_exam_result_search_pdf/{id}', 'AdminExamController@individual_std_exam_result_search_pdf')->name('admin.individualStdExamResultSearchPdf');

    Route::middleware('check.permission:view-mcq-results')->group(function () {
        Route::get('/exams', 'AdminExamController@exam_list')->name('admin.examList');
        Route::get('/add_exam', 'AdminExamController@add_exam')->name('admin.addExam');
        Route::post('/create_exam', 'AdminExamController@create_exam')->name('admin.createExam');
        Route::get('/exam_result/{id}', 'AdminExamController@exam_result')->name('admin.examResult');
        Route::get('/individul_exam_result_list/{id}', 'AdminExamController@individual_std_exam_result_list')
            ->name('admin.individualStdExamResult');
        Route::get('/individul_exam_result_search/{id}', 'AdminExamController@individual_std_exam_result_search')
            ->name('admin.individualStdExamResultSearch');
        Route::get('/individul_exam_result_search_pdf/{id}', 'AdminExamController@individual_std_exam_result_search_pdf')
            ->name('admin.individualStdExamResultSearchPdf');
    });

});




Route::group(['prefix' => 'teacher', 'middleware' => ['teacher']], function () {


    //Dashboard

    Route::get('dashboard', 'TeacherDashboardController@index')->name('teacher.dashboard');


    Route::get('/profile', 'AdminLoginController@profile')->name('teacher.profile');
    Route::post('/change_profile', 'AdminLoginController@changeProfile')->name('teacher.changeProfile.post');
    Route::post('/change_password', 'AdminLoginController@changePassword')->name('teacher.changePassword.post');


    Route::get('homework', 'TeacherHomeworkController@index')->name('teacher.homework');
    Route::get('pdf_homework/{id}', 'TeacherHomeworkController@pdfHomework')->name('teacher.pdfHomework');
    Route::get('evaluate_homework/{id}', 'TeacherHomeworkController@evaluateHomework')->name('teacher.evaluateHomework');
    Route::post('evaluate_homework/{id}', 'TeacherHomeworkController@evaluateHomeworkScore')->name('teacher.evaluateHomework');


    //Zoom

    Route::get('/meetings', 'TeacherZoomClass@list')->name('teacher.zoom');
    Route::get('/add_meetings', 'TeacherZoomClass@add');
    Route::post('/meetings', 'TeacherZoomClass@create');
    Route::post('/change_status_id', 'TeacherZoomClass@changeStatus');
    Route::get('/meetings/{id}', 'TeacherZoomClass@get')->where('id', '[0-9]+');
    // Route::patch('/meetings/{id}', 'ZoomClass@update')->where('id', '[0-9]+');
    Route::get('/meetings/delete/{id}', 'TeacherZoomClass@delete');

    Route::get('/edit_meeting/{id}', 'TeacherZoomClass@edit');
    Route::patch('/meetings/{id}', 'TeacherZoomClass@update')->where('id', '[0-9]+');


    Route::get('/meetings/participants/{id}', 'TeacherZoomClass@participant_list');
    Route::post('/meetings/submit_attendance', 'TeacherZoomClass@submit_attendance');
    Route::get('/meetings/attendance/{id}', 'TeacherZoomClass@attendance_list');


    // Cq Exam

    //Cq Exam


    Route::get('/cq_exams', 'TeacherCQExamController@exam_list')->name('teacher.cqExamList');
    Route::get('/add_cq_exam', 'TeacherCQExamController@add_cq_exam')->name('teacher.addCqExam');
    Route::post('/create_cq_exam', 'TeacherCQExamController@create_cq_exam')->name('teacher.createCqExam');
    Route::post('/change_cq_exam_status/', 'TeacherCQExamController@change_cq_exam_status')->name('teacher.changeCqExamStatus');
    Route::get('/edit_cq_exam/{id}', 'TeacherCQExamController@edit_cq_exam')->name('teacher.editCqExam');
    Route::post('/update_cq_exam/{id}', 'TeacherCQExamController@update_cq_exam')->name('teacher.updateCqExam');
    Route::get('/delete_cq_exam/{id}', 'TeacherCQExamController@delete_cq_exam')->name('teacher.deleteCqExam');
    Route::get('/add_cq_question/{id}', 'TeacherCQExamController@add_cq_question')->name('teacher.addCqQuestion');

    Route::post('/upload_cq_image', 'TeacherCQExamController@upload_cq_image')->name('teacher.uploadCqImage');

    Route::post('/create_cq_question', 'TeacherCQExamController@create_cq_question')->name('teacher.createCqQuestion');
    Route::get('/view_cq_question/{id}', 'TeacherCQExamController@view_cq_question')->name('teacher. viewCqQuestion');
    Route::get('/edit_cq_question/{id}', 'TeacherCQExamController@edit_cq_question')->name('teacher.editCqQuestion');
    Route::post('/update_cq_question/{id}', 'TeacherCQExamController@update_cq_question')->name('teacher.updateCqQuestion');
    Route::get('/delete_cq_question/{id}', 'TeacherCQExamController@delete_cq_question')->name('teacher.deleteCqQuestion');


    Route::get('/cq_exam_result', 'TeacherCQExamController@cq_exam_result')->name('teacher.cqExamResult');
    Route::get('/cq_exam_result/{id}', 'TeacherCQExamController@cq_exam_result_view')->name('teacher.cqExamResultView');
    Route::get('/cq_student_answer/{exam_id}/student/{student_id}', 'TeacherCQExamController@pdfStudentAnswer')->name('teacher.pdfStudentAnswer');

    Route::get('/cq_student_marking/{exam_id}/student/{student_id}', 'TeacherCQExamController@studentMarking')->name('teacher.studentMarking');

    Route::post('/cq_exam_marking_update', 'TeacherCQExamController@studentMarkingUpdate')->name('teacher.studentMarkingUpdate');

    Route::get('/cq_add_solve_sheet/{id}', 'TeacherCQExamController@add_solve_sheet')->name('teacher.add_solve_sheet');

    Route::post('/cq_post_solve_sheet/{id}', 'TeacherCQExamController@post_solve_sheet')->name('teacher.post_solve_sheet');
    Route::get('/solve_download/{path}', 'TeacherCQExamController@solve_download');

    Route::post('/change_cq_rank_publish_status', 'TeacherCQExamController@changeRankPublishStatus')->name('teacher.changeMcqExamrankPublishStatus');
});
