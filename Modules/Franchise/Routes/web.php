<?php

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



Route::prefix('franchise')->group(function() {
    Route::get('clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
      Artisan::call('config:clear');
        return "Cache,View is cleared";
    });
    
    Route::middleware(['web'])->group(function () {
        
        Route::get('plan-days-left-cron', 'FranchiseController@days_left_cron')->name('plan-days-left-cron');
    
    });

    Route::middleware(['franchise_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('franchise-login', ['uses' => 'AuthController@get_login', 'as' => 'franchise-login']);
        Route::post('franchise-login', ['uses' => 'AuthController@post_login', 'as' => 'franchise-login']);
        Route::get('franchise-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'franchise-lockscreen']);
        Route::post('franchise-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'franchise-lockscreen']);
        Route::get('forgot-password', 'AuthController@get_forgot_password')->name('franchise-forgot-password');
        Route::post('forgot-password', 'AuthController@post_forgot_password')->name('franchise-forgot-password');
        Route::get('reset-password/{id}/{token}', 'AuthController@get_reset_password')->name('franchise-reset-password');
        Route::post('set-password', 'AuthController@post_reset_password')->name('franchise-set-password');
    });

    Route::middleware(['franchise_logged_in'])->group(function () {
        
        Route::get('franchise-dashboard', ['uses' => 'DashboardController@index', 'as' => 'franchise-dashboard']);
        Route::get('franchise-logout', ['uses' => 'AuthController@logout', 'as' => 'franchise-logout']);
        Route::get('franchise-profile', ['uses' => 'DashboardController@get_profile', 'as' => 'franchise-profile']);
        Route::post('franchise-profile', ['uses' => 'DashboardController@post_profile', 'as' => 'franchise-profile']);

        Route::get('franchise-change-password', ['uses' => 'DashboardController@get_change_password', 'as' => 'franchise-change-password']);
        Route::post('franchise-change-password', ['uses' => 'DashboardController@post_change_password', 'as' => 'franchise-change-password']);
        Route::get('user-change-image', ['uses' => 'DashboardController@get_change_image', 'as' => 'franchise-user-change-image']);
        Route::post('user-change-image', ['uses' => 'DashboardController@post_change_image', 'as' => 'franchise-user-change-image']);
        
        Route::get('user-sign-image', ['uses' => 'DashboardController@get_sign_image', 'as' => 'franchise-user-sign-image']);
        Route::post('user-sign-image', ['uses' => 'DashboardController@post_sign_image', 'as' => 'franchise-user-sign-image']);
        

        Route::get('franchise-logout', ['uses' => 'AuthController@logout', 'as' => 'franchise-logout']);

        

        Route::get('login-history', ['uses' => 'LoginHistoryController@index', 'as' => 'login-history']);
        Route::get('login-history-list', ['uses' => 'LoginHistoryController@get_list', 'as' => 'login-history-list']);
        
       
        Route::group(['middleware'=>'daysleft'],function(){
            
            Route::get('franchise-wallet', ['uses' => 'WalletRechargeController@get_wallet_amount', 'as' => 'franchise-wallet']);
            Route::post('franchise-wallet', ['uses' => 'WalletRechargeController@post_wallet_amount', 'as' => 'franchise-wallet']);
            Route::post('success-recharge-wallet', 'WalletRechargeController@post_success_recharge_wallet')->name('success-recharge-wallet');
            Route::post('cancel-recharge-wallet', 'WalletRechargeController@post_cancel_recharge_wallet')->name('cancel-recharge-wallet');
            
            Route::get('franchise-wallet-history-list', ['uses' => 'WalletHistoryController@get_list', 'as' => 'franchise-wallet-history-list']);
            Route::get('franchise-wallet-history', ['uses' => 'WalletHistoryController@index', 'as' => 'franchise-wallet-history']);
            
            Route::get('students', ['uses' => 'StudentController@get_user_list', 'as' => 'franchise-students']);
            Route::get('student-list-datatable', ['uses' => 'StudentController@get_user_list_datatable', 'as' => 'franchise-student-list-datatable']);
            Route::get('student-add', ['uses' => 'StudentController@get_add_user', 'as' => 'franchise-student-add']);
            
            Route::post('student-add', ['uses' => 'StudentController@post_add_user', 'as' => 'franchise-student-add']);
            Route::post('success-student-add', 'StudentController@post_success_student_add')->name('success-student-add');
            Route::post('cancel-student-add', 'StudentController@post_cancel_student_add')->name('cancel-student-add');
            
            Route::get('student-edit/{id}', ['uses' => 'StudentController@get_edit_user', 'as' => 'franchise-student-edit']);
            Route::put('student-edit/{id}', ['uses' => 'StudentController@post_edit_user', 'as' => 'franchise-student-edit']);
            // Route::get('student-delete/{id}', ['uses' => 'StudentController@delete', 'as' => 'franchise-student-delete']);
            
            Route::get('student-choose-assign-course/{id}', ['uses' => 'StudentController@get_choose_assign_course', 'as' => 'franchise-student-choose-assign-course']);
            Route::post('student-choose-assign-course/{id}', ['uses' => 'StudentController@post_choose_assign_course', 'as' => 'franchise-student-choose-assign-course']);
            
            Route::get('student-assign-course/{id}//{course}', ['uses' => 'StudentController@get_edit_assign_course', 'as' => 'franchise-student-assign-course']);
            
            // Route::get('student-assign-course/{id}/{value}', ['uses' => 'StudentController@get_edit_assign_course', 'as' => 'franchise-student-assign-course']);
            
            Route::put('student-assign-course/{id}', ['uses' => 'StudentController@post_edit_assign_course', 'as' => 'franchise-student-assign-course']);
            Route::post('success-student-assign-course/{user_id}', 'StudentController@post_success_student_assign')->name('success-student-assign-course');
            Route::post('cancel-student-assign-course', 'StudentController@post_cancel_student_assign')->name('cancel-student-assign-course');
            
            Route::get('/student-assign-course-list/{id}', 'StudentController@assign_course_list')->name('franchise-student-assign-course-list');
            Route::get('/student-assign-course-list/datatables/{id}', 'StudentController@assign_course_list_datatables')->name('franchise-student-assign-course-list-datatables');
            Route::get('/student-i-card/{id}', ['uses' => 'StudentController@download_i_card', 'as' => 'student-i-card']);
        
            Route::get('/course/datatables', 'CourseController@datatables')->name('franchise-course-datatables'); //JSON REQUEST
            Route::get('/course', 'CourseController@index')->name('franchise-course-index');
            Route::get('/course/create', 'CourseController@create')->name('franchise-course-create');
            Route::post('/course/create', 'CourseController@store')->name('franchise-course-store');
            Route::get('/course/edit/{id}', 'CourseController@edit')->name('franchise-course-edit');
            Route::post('/course/edit/{id}', 'CourseController@update')->name('franchise-course-update');
            Route::get('/course/delete/{id}', 'CourseController@destroy')->name('franchise-course-delete');
            
            Route::get('/course-question-answer/{id}', 'CourseController@question_answer')->name('franchise-course-question-answer'); //* w.r.t. particular course
            Route::get('/course-question-answer/datatables/{id}', 'CourseController@question_answer_datatables')->name('franchise-course-question-answer-datatables');
            
            Route::get('/course/module/{id}', 'CourseController@module')->name('franchise-course-module');
            Route::get('/course/module/datatables/{id}', 'CourseController@module_datatables')->name('franchise-course-module-datatables');
            Route::get('/course/module/add/{id}', 'CourseController@module_add')->name('franchise-course-module-add');
            Route::post('/course/module/add/{id}', 'CourseController@post_module_add')->name('franchise-course-module-add');
            Route::get('/course/module/edit/{id}', 'CourseController@module_edit')->name('franchise-course-module-edit');
            Route::post('/course/module/edit/{id}', 'CourseController@post_module_edit')->name('franchise-course-module-edit');
            Route::get('/course/module/delete/{id}', 'CourseController@module_delete')->name('franchise-course-module-delete');
            
            
            Route::get('/course/module/video/{id}', 'CourseController@module_video')->name('franchise-course-module-video');
            Route::get('/course/module/video/datatables/{id}', 'CourseController@module_video_datatables')->name('franchise-course-module-video-datatables');
            Route::get('/course/module/video/add/{id}', 'CourseController@module_video_add')->name('franchise-course-module-video-add');
            Route::post('/course/module/video/add/{id}', 'CourseController@post_module_video_add')->name('franchise-course-module-video-add');
            Route::get('/course/module/video/edit/{id}', 'CourseController@module_video_edit')->name('franchise-course-module-video-edit');
            Route::post('/course/module/video/edit/{id}', 'CourseController@post_module_video_edit')->name('franchise-course-module-video-edit');
            Route::get('/course/module/video/delete/{id}', 'CourseController@module_video_delete')->name('franchise-course-module-video-delete');
            
            Route::get('/franchise-course-live-class-data/{id}', 'CourseController@live_class_data')->name('franchise-course-live-class-data');
            Route::get('/franchise-course-live-class-list/{id}', 'CourseController@live_class_list')->name('franchise-course-live-class-list');
            Route::get('/franchise-course-live-class/{id}', 'CourseController@get_live_class')->name('franchise-course-live-class');
            Route::post('/franchise-course-live-class/{id}', 'CourseController@post_live_class')->name('franchise-course-live-class');
            
            Route::get('/franchise-course-live-class-delete/{id}', 'CourseController@delete_live_class')->name('franchise-course-live-class-delete');
        
            Route::get('/question-answer/datatables', 'QuestionAnswerController@datatables')->name('franchise-question-answer-datatables'); //JSON REQUEST
            Route::get('/question-answer', 'QuestionAnswerController@index')->name('franchise-question-answer-index'); //* all course
            Route::get('/question-answer/create', 'QuestionAnswerController@create')->name('franchise-question-answer-create');
            Route::post('/question-answer/create', 'QuestionAnswerController@store')->name('franchise-question-answer-store');
            Route::get('/question-answer/edit/{id}', 'QuestionAnswerController@edit')->name('franchise-question-answer-edit');
            Route::post('/question-answer/edit/{id}', 'QuestionAnswerController@update')->name('franchise-question-answer-update');
            Route::get('/question-answer/delete/{id}', 'QuestionAnswerController@destroy')->name('franchise-question-answer-delete');
        
            Route::get('/student-exam-answer/datatables', 'StudentCourseAnswerController@datatables')->name('franchise-student-exam-answer-datatables'); //JSON REQUEST
            Route::get('/student-exam-answer', 'StudentCourseAnswerController@index')->name('franchise-student-exam-answer-index');
            Route::get('/student-exam-answer/edit/{id}', 'StudentCourseAnswerController@get_edit')->name('franchise-student-exam-answer-getedit');
            
            Route::put('/student-exam-answer-edit/{id}', ['uses' => 'StudentCourseAnswerController@post_edit', 'as' => 'franchise-student-exam-answer-edit']);
            Route::post('success-exam-fees', 'StudentCourseAnswerController@post_success_exam_fees')->name('success-exam-fees');
            Route::post('cancel-exam-fees', 'StudentCourseAnswerController@post_cancel_exam_fees')->name('cancel-exam-fees');
            
            Route::get('/student-exam-answer/view/{id}', 'StudentCourseAnswerController@view')->name('franchise-student-exam-answer-view');
            Route::get('/exam-certificate-download/{id}', ['uses' => 'StudentCourseAnswerController@exam_certificate_download', 'as' => 'franchise-exam-certificate-download']);
            Route::get('/exam-result-download/{id}', ['uses' => 'StudentCourseAnswerController@exam_result_download', 'as' => 'franchise-exam-result-download']);
            
            Route::get('/franch-student-certificate/delivered/{id}', ['uses' => 'StudentCourseAnswerController@exam_certificate_delivered', 'as' => 'franch-student-exam-certificate-delivered']);
            Route::post('/franch-student-certificate-delivered/{id}', ['uses' => 'StudentCourseAnswerController@post_exam_certificate_delivered', 'as' => 'franch-student-certificate-delivered']);
            
            
            Route::get('/franchise-certificate/datatables', 'FranchiseCertificateController@datatables')->name('franchise-certificate-datatables'); //JSON REQUEST
            Route::get('/franchise-certificate-index', 'FranchiseCertificateController@index')->name('franchise-certificate-index');
            Route::get('/franchise-certificate-view/{id}', 'FranchiseCertificateController@view_certificate')->name('franchise-certificate-view');
            Route::get('/franchise-certificate-download/{id}', ['uses' => 'FranchiseCertificateController@download_certificate', 'as' => 'franchise-certificate-download']);
            
            
            Route::get('/franchise-banner/datatables', 'FranchiseBannerController@datatables')->name('franchise-banner-datatables'); //JSON REQUEST
            Route::get('/franchise-banner-index', 'FranchiseBannerController@index')->name('franchise-banner-index');
            Route::get('/franchise-banner-download/{file}', ['uses' => 'FranchiseBannerController@download_banner', 'as' => 'franchise-banner-download']);
            
            
            Route::get('franchise-elements', ['uses' => 'ElementController@get_element_list', 'as' => 'franchise-elements']);
            Route::get('franchise-element-list-datatable', ['uses' => 'ElementController@get_element_list_datatable', 'as' => 'franchise-element-list-datatable']);
            Route::get('franchise-element-purchase/{id}', ['uses' => 'ElementController@get_view_element', 'as' => 'franchise-element-purchase']);
            Route::put('franchise-element-purchase/{id}', ['uses' => 'ElementController@post_view_element', 'as' => 'franchise-element-purchase']);
            Route::post('success-element-purchase', 'ElementController@post_success_element_purchase')->name('success-element-purchase');
            Route::post('cancel-element-purchase', 'ElementController@post_cancel_element_purchase')->name('cancel-element-purchase');
            
            Route::get('franchise-order-elements', ['uses' => 'FranchiseOrderController@get_element_order_list', 'as' => 'franchise-order-elements']);
            Route::get('franchise-order-element-list-datatable', ['uses' => 'FranchiseOrderController@get_element_order_list_datatable', 'as' => 'franchise-order-element-list-datatable']);
            
            
            Route::get('centers', ['uses' => 'FranchiseCenterController@get_center_list', 'as' => 'franchise-centers']);
            Route::get('center-list-datatable', ['uses' => 'FranchiseCenterController@get_center_list_datatable', 'as' => 'franchise-center-list-datatable']);
            Route::get('center-add', ['uses' => 'FranchiseCenterController@get_add_center', 'as' => 'franchise-center-add']);
            Route::post('center-add', ['uses' => 'FranchiseCenterController@post_add_center', 'as' => 'franchise-center-add']);
            Route::post('success-center-add', 'FranchiseCenterController@post_success_center_add')->name('success-center-add');
            Route::post('cancel-center-add', 'FranchiseCenterController@post_cancel_center_add')->name('cancel-center-add');
            
            
            Route::get('/course-live-class-data', 'LiveClassController@datatable')->name('course-live-class-data');
            Route::get('/course-live-class-list', 'LiveClassController@live_class')->name('course-live-class-list');
            Route::get('/course-live-class-add', 'LiveClassController@get_add_live_class')->name('course-live-class-add');
            Route::post('/course-live-class-add', 'LiveClassController@store')->name('course-live-class-add');
            Route::get('/course-live-class-delete/{id}', 'LiveClassController@destroy')->name('course-live-class-delete');
        
        });
        
        
        Route::get('franchise-renew-plan', ['uses' => 'FranchiseRenewController@get_renew_plan', 'as' => 'franchise-renew-plan']);
        Route::post('franchise-renew-plan', ['uses' => 'FranchiseRenewController@post_renew_plan', 'as' => 'franchise-renew-plan']);
        
        Route::post('success-renew-plan', 'FranchiseRenewController@post_success_renew_plan')->name('success-renew-plan');
        Route::post('cancel-renew-plan', 'FranchiseRenewController@post_cancel_renew_plan')->name('cancel-renew-plan');
        
        
        
    });
});
