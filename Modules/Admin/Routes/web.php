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

Route::prefix('admin')->group(function () {

    Route::get('clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
      Artisan::call('config:clear');
        return "Cache,View is cleared";
    });

    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });

    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);
        Route::get('admin-profile', ['uses' => 'DashboardController@get_profile', 'as' => 'admin-profile']);
        Route::post('admin-profile', ['uses' => 'DashboardController@post_profile', 'as' => 'admin-profile']);

        Route::get('admin-change-password', ['uses' => 'DashboardController@get_change_password', 'as' => 'admin-change-password']);
        Route::post('admin-change-password', ['uses' => 'DashboardController@post_change_password', 'as' => 'admin-change-password']);
        Route::get('user-change-image', ['uses' => 'DashboardController@get_change_image', 'as' => 'user-change-image']);
        Route::post('user-change-image', ['uses' => 'DashboardController@post_change_image', 'as' => 'user-change-image']);
        
        Route::get('center-incharge-image', ['uses' => 'DashboardController@get_center_incharge_image', 'as' => 'center-incharge-image']);
        Route::post('center-incharge-image', ['uses' => 'DashboardController@post_center_incharge_image', 'as' => 'center-incharge-image']);

        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);

        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']);
        Route::post('settings', ['uses' => 'SettingsController@store', 'as' => 'settings']);

        Route::get('login-history', ['uses' => 'LoginHistoryController@index', 'as' => 'login-history']);
        Route::get('login-history-list', ['uses' => 'LoginHistoryController@get_list', 'as' => 'login-history-list']);

        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);
        Route::get('emailNotification-list', ['uses' => 'EmailNotificationController@get_list', 'as' => 'emailNotification-list']);
        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);

        Route::get('contactus-list', ['uses' => 'ContactusController@get_list', 'as' => 'contactus-list']);
        Route::get('contactus', ['uses' => 'ContactusController@index', 'as' => 'contactus']);
        Route::get('contactus-view/{id}', ['uses' => 'ContactusController@get_view', 'as' => 'contactus-view']);
        Route::get('contactus-delete/{id}', ['uses' => 'ContactusController@delete', 'as' => 'contactus-delete']);
        
        Route::get('enquiry-list', ['uses' => 'EnquiryController@get_list', 'as' => 'enquiry-list']);
        Route::get('enquiry', ['uses' => 'EnquiryController@index', 'as' => 'enquiry']);
        Route::get('enquiry-view/{id}', ['uses' => 'EnquiryController@get_view', 'as' => 'enquiry-view']);
        Route::get('enquiry-delete/{id}', ['uses' => 'EnquiryController@delete', 'as' => 'enquiry-delete']);
        
        Route::get('wallet-history-list', ['uses' => 'WalletHistoryController@get_list', 'as' => 'wallet-history-list']);
        Route::get('wallet-history', ['uses' => 'WalletHistoryController@index', 'as' => 'wallet-history']);
        Route::get('wallet-history-delete/{id}', ['uses' => 'WalletHistoryController@delete', 'as' => 'wallet-history-delete']);
       
        
        Route::get('faq-list', ['uses' => 'FAQController@get_list', 'as' => 'faq-list']);
        Route::get('faq', ['uses' => 'FAQController@index', 'as' => 'faq']);
        Route::get('faq-add', ['uses' => 'FAQController@get_add', 'as' => 'faq-add']);
        Route::post('faq-add', ['uses' => 'FAQController@post_add', 'as' => 'faq-add']);
        Route::get('faq-edit/{id}', ['uses' => 'FAQController@get_edit', 'as' => 'faq-edit']);
        Route::post('faq-edit/{id}', ['uses' => 'FAQController@post_edit', 'as' => 'faq-edit']);
        Route::get('faq-delete/{id}', ['uses' => 'FAQController@delete', 'as' => 'faq-delete']);
        
        
        Route::get('elements', ['uses' => 'ElementController@get_element_list', 'as' => 'elements']);
        Route::get('element-list-datatable', ['uses' => 'ElementController@get_element_list_datatable', 'as' => 'element-list-datatable']);
        Route::get('element-add', ['uses' => 'ElementController@get_add_element', 'as' => 'element-add']);
        Route::post('element-add', ['uses' => 'ElementController@post_add_element', 'as' => 'element-add']);
        Route::get('element-edit/{id}', ['uses' => 'ElementController@get_edit_element', 'as' => 'element-edit']);
        Route::put('element-edit/{id}', ['uses' => 'ElementController@post_edit_element', 'as' => 'element-edit']);
        Route::get('element-delete/{id}', ['uses' => 'ElementController@delete', 'as' => 'element-delete']);
        
        
        
        
        Route::get('subscriber-list', ['uses' => 'SubscribersController@get_list', 'as' => 'subscriber-list']);
        Route::get('subscribers', ['uses' => 'SubscribersController@index', 'as' => 'subscribers']);
        Route::get('subscriberleads-form-csv', ['uses' => 'SubscribersController@get_subscribers_csv', 'as' => 'subscriber-csv']);

        Route::resource('static-page', 'StaticpageController');
        
        Route::get('menu-list', ['uses' => 'MenuController@get_list', 'as' => 'menu-list']);
        Route::get('menu', ['uses' => 'MenuController@index', 'as' => 'menu']);
        Route::get('menu-add', ['uses' => 'MenuController@get_add', 'as' => 'menu-add']);
        Route::post('menu-add', ['uses' => 'MenuController@post_add', 'as' => 'menu-add']);
        Route::get('menu-edit/{id}', ['uses' => 'MenuController@get_edit', 'as' => 'menu-edit']);
        Route::post('menu-edit/{id}', ['uses' => 'MenuController@post_edit', 'as' => 'menu-edit']);
        Route::get('menu-delete/{id}', ['uses' => 'MenuController@delete', 'as' => 'menu-delete']);

        Route::get('cms', ['uses' => 'CmsController@index', 'as' => 'cms']);
        Route::get('cms-list', ['uses' => 'CmsController@get_list', 'as' => 'cms-list']);
        Route::get('cms-edit/{id}', ['uses' => 'CmsController@get_edit', 'as' => 'cms-edit']);
        Route::post('cms-edit/{id}', ['uses' => 'CmsController@post_edit', 'as' => 'cms-edit']);

        Route::get('leads-form', ['uses' => 'LeadsController@get_list', 'as' => 'leads-form']);
        Route::get('leads-form-list-datatable', ['uses' => 'LeadsController@get_leads_form_list_datatable', 'as' => 'leads-form-list-datatable']);
        Route::get('leads-form-csv', ['uses' => 'LeadsController@get_leads_form_csv', 'as' => 'leads-form-csv']);

        Route::get('students', ['uses' => 'StudentController@get_user_list', 'as' => 'students']);
        Route::get('student-list-datatable', ['uses' => 'StudentController@get_user_list_datatable', 'as' => 'student-list-datatable']);
        Route::get('student-add', ['uses' => 'StudentController@get_add_user', 'as' => 'student-add']);
        Route::post('student-add', ['uses' => 'StudentController@post_add_user', 'as' => 'student-add']);
        Route::get('student-edit/{id}', ['uses' => 'StudentController@get_edit_user', 'as' => 'student-edit']);
        Route::put('student-edit/{id}', ['uses' => 'StudentController@post_edit_user', 'as' => 'student-edit']);
        Route::get('student-delete/{id}', ['uses' => 'StudentController@delete', 'as' => 'student-delete']);
        Route::get('student-assign-course/{id}', ['uses' => 'StudentController@get_edit_assign_course', 'as' => 'student-assign-course']);
        Route::put('student-assign-course/{id}', ['uses' => 'StudentController@post_edit_assign_course', 'as' => 'student-assign-course']);
        Route::get('/student-assign-course-list/{id}', 'StudentController@assign_course_list')->name('admin-student-assign-course-list');
        Route::get('/student-assign-course-list/datatables/{id}', 'StudentController@assign_course_list_datatables')->name('admin-student-assign-course-list-datatables');
        Route::get('/admin-student-i-card/{id}', ['uses' => 'StudentController@download_i_card', 'as' => 'admin-student-i-card']);

        Route::get('/course/datatables', 'CourseController@datatables')->name('admin-course-datatables'); //JSON REQUEST
        Route::get('/course', 'CourseController@index')->name('admin-course-index');
        Route::get('/course/create', 'CourseController@create')->name('admin-course-create');
        Route::post('/course/create', 'CourseController@store')->name('admin-course-store');
        Route::get('/course/edit/{id}', 'CourseController@edit')->name('admin-course-edit');
        Route::post('/course/edit/{id}', 'CourseController@update')->name('admin-course-update');
        Route::get('/course/delete/{id}', 'CourseController@destroy')->name('admin-course-delete');
        Route::get('/course-question-answer/{id}', 'CourseController@question_answer')->name('admin-course-question-answer');
        Route::get('/course-question-answer/datatables/{id}', 'CourseController@question_answer_datatables')->name('admin-course-question-answer-datatables');
        Route::get('/course/module/{id}', 'CourseController@module')->name('admin-course-module');
        Route::get('/course/module/datatables/{id}', 'CourseController@module_datatables')->name('admin-course-module-datatables');
        Route::get('/course/module/add/{id}', 'CourseController@module_add')->name('admin-course-module-add');
        Route::post('/course/module/add/{id}', 'CourseController@post_module_add')->name('admin-course-module-add');
        Route::get('/course/module/edit/{id}', 'CourseController@module_edit')->name('admin-course-module-edit');
        Route::post('/course/module/edit/{id}', 'CourseController@post_module_edit')->name('admin-course-module-edit');
        Route::get('/course/module/delete/{id}', 'CourseController@module_delete')->name('admin-course-module-delete');
        
        Route::get('/course/module/video/{id}', 'CourseController@module_video')->name('admin-course-module-video');
        Route::get('/course/module/video/datatables/{id}', 'CourseController@module_video_datatables')->name('admin-course-module-video-datatables');
        Route::get('/course/module/video/add/{id}', 'CourseController@module_video_add')->name('admin-course-module-video-add');
        Route::post('/course/module/video/add/{id}', 'CourseController@post_module_video_add')->name('admin-course-module-video-add');
        Route::get('/course/module/video/edit/{id}', 'CourseController@module_video_edit')->name('admin-course-module-video-edit');
        Route::post('/course/module/video/edit/{id}', 'CourseController@post_module_video_edit')->name('admin-course-module-video-edit');
        Route::get('/course/module/video/delete/{id}', 'CourseController@module_video_delete')->name('admin-course-module-video-delete');
        
        
        Route::get('/admin-course-live-class-data/{id}', 'CourseController@live_class_data')->name('admin-course-live-class-data');
        Route::get('/admin-course-live-class-list/{id}', 'CourseController@live_class_list')->name('admin-course-live-class-list');
        Route::get('/admin-course-live-class/{id}', 'CourseController@get_live_class')->name('admin-course-live-class');
        Route::post('/admin-course-live-class/{id}', 'CourseController@post_live_class')->name('admin-course-live-class');
            
        Route::get('/admin-course-live-class-delete/{id}', 'CourseController@delete_live_class')->name('admin-course-live-class-delete');

        Route::get('/question-answer/datatables', 'QuestionAnswerController@datatables')->name('admin-question-answer-datatables'); //JSON REQUEST
        Route::get('/question-answer', 'QuestionAnswerController@index')->name('admin-question-answer-index');
        Route::get('/question-answer/create', 'QuestionAnswerController@create')->name('admin-question-answer-create');
        Route::post('/question-answer/create', 'QuestionAnswerController@store')->name('admin-question-answer-store');
        Route::get('/question-answer/edit/{id}', 'QuestionAnswerController@edit')->name('admin-question-answer-edit');
        Route::post('/question-answer/edit/{id}', 'QuestionAnswerController@update')->name('admin-question-answer-update');
        Route::get('/question-answer/delete/{id}', 'QuestionAnswerController@destroy')->name('admin-question-answer-delete');

        Route::get('/student-exam-answer/datatables', 'StudentCourseAnswerController@datatables')->name('admin-student-exam-answer-datatables'); //JSON REQUEST
        Route::get('/student-exam-answer', 'StudentCourseAnswerController@index')->name('admin-student-exam-answer-index');
        Route::get('/student-exam-answer/edit/{id}', 'StudentCourseAnswerController@get_edit')->name('admin-student-exam-answer-edit');
        Route::put('/student-exam-answer-edit/{id}', ['uses' => 'StudentCourseAnswerController@post_edit', 'as' => 'student-exam-answer-edit']);
        Route::get('/student-exam-answer/view/{id}', 'StudentCourseAnswerController@view')->name('admin-student-exam-answer-view');
        Route::get('/exam-certificate-download/{id}', ['uses' => 'StudentCourseAnswerController@exam_certificate_download', 'as' => 'exam-certificate-download']);
        Route::get('/exam-result-download/{id}', ['uses' => 'StudentCourseAnswerController@exam_result_download', 'as' => 'exam-result-download']);
        Route::get('/exam-certificate/delivered/{id}', ['uses' => 'StudentCourseAnswerController@exam_certificate_delivered', 'as' => 'exam-certificate-delivered']);
        Route::post('/exam-certificate-delivered/{id}', ['uses' => 'StudentCourseAnswerController@post_exam_certificate_delivered', 'as' => 'certificate-delivered']);
        
        
        Route::get('/slider/datatables', 'SliderController@datatables')->name('admin-slider-datatables'); //JSON REQUEST
        Route::get('/slider', 'SliderController@index')->name('admin-slider-index');
        Route::get('/slider/create', 'SliderController@create')->name('admin-slider-create');
        Route::post('/slider/create', 'SliderController@store')->name('admin-slider-store');
        Route::get('/slider/edit/{id}', 'SliderController@edit')->name('admin-slider-edit');
        Route::post('/slider/edit/{id}', 'SliderController@update')->name('admin-slider-update');
        Route::get('/slider/delete/{id}', 'SliderController@destroy')->name('admin-slider-delete');
        
        Route::get('/gallery/datatables', 'GalleryController@datatables')->name('admin-gallery-datatables'); //JSON REQUEST
        Route::get('/gallery', 'GalleryController@index')->name('admin-gallery-index');
        Route::get('/gallery/create', 'GalleryController@create')->name('admin-gallery-create');
        Route::post('/gallery/create', 'GalleryController@store')->name('admin-gallery-store');
        Route::get('/gallery/edit/{id}', 'GalleryController@edit')->name('admin-gallery-edit');
        Route::post('/gallery/edit/{id}', 'GalleryController@update')->name('admin-gallery-update');
        Route::get('/gallery/delete/{id}', 'GalleryController@destroy')->name('admin-gallery-delete');
        
        
        
        
        Route::get('affiliation-plan/datatables', 'PlanController@datatables')->name('affiliation-plan-datatables'); //JSON REQUEST
        Route::get('affiliation-plan', 'PlanController@index')->name('affiliation-plan');
        Route::get('affiliation-plan-add', 'PlanController@get_add')->name('affiliation-plan-add');
        Route::post('affiliation-plan-add', 'PlanController@post_add')->name('affiliation-plan-add');
        Route::get('affiliation-plan-edit/{id}', 'PlanController@get_edit')->name('affiliation-plan-edit');
        Route::post('affiliation-plan-edit/{id}', 'PlanController@post_edit')->name('affiliation-plan-edit');
        Route::get('affiliation-plan-delete/{id}', 'PlanController@delete')->name('affiliation-plan-delete');
        
        
        Route::get('franchise-request-list', ['uses' => 'FranchiseRequestController@get_list', 'as' => 'franchise-request-list']);
        Route::get('franchise-request', ['uses' => 'FranchiseRequestController@index', 'as' => 'franchise-request']);
        Route::get('franchise-request-edit/{id}', ['uses' => 'FranchiseRequestController@get_edit', 'as' => 'franchise-request-edit']);
        Route::put('franchise-request-edit/{id}', ['uses' => 'FranchiseRequestController@post_edit', 'as' => 'franchise-request-edit']);
        Route::get('franchise-request-delete/{id}', ['uses' => 'FranchiseRequestController@delete', 'as' => 'franchise-request-delete']);
        Route::get('view-franchise-student-list-data/{id}', ['uses' => 'FranchiseRequestController@get_student_data', 'as' => 'view-franchise-student-list-data']);
        Route::get('view-franchise-student-list/{id}', ['uses' => 'FranchiseRequestController@get_student_list', 'as' => 'view-franchise-student-list']);
        Route::get('view-franchise-course-list-data/{id}', ['uses' => 'FranchiseRequestController@get_course_data', 'as' => 'view-franchise-course-list-data']);
        Route::get('view-franchise-course-list/{id}', ['uses' => 'FranchiseRequestController@get_course_list', 'as' => 'view-franchise-course-list']);
        
        Route::get('franchise-request-upload-agreement/{id}', ['uses' => 'FranchiseRequestController@get_upload_agreement', 'as' => 'franchise-request-upload-agreement']);
        Route::post('franchise-request-upload-agreement/{id}', ['uses' => 'FranchiseRequestController@post_upload_agreement', 'as' => 'franchise-request-upload-agreement']);
        
        Route::get('franchise-request-add-banners', ['uses' => 'FranchiseBannerController@add_banners', 'as' => 'franchise-request-add-banners']);
        Route::put('franchise-request-add-banners', ['uses' => 'FranchiseBannerController@post_add_banners', 'as' => 'franchise-request-add-banners']);
        Route::get('franchise-request-banners', ['uses' => 'FranchiseBannerController@get_banners', 'as' => 'franchise-request-banners']);
        Route::get('franchise-request-banners-list', ['uses' => 'FranchiseBannerController@get_banners_list', 'as' => 'franchise-request-banners-list']);
        Route::get('franchise-request-banners-edit/{id}', ['uses' => 'FranchiseBannerController@edit_banners', 'as' => 'franchise-request-banners-edit']);
        Route::put('franchise-request-banners-edit/{id}', ['uses' => 'FranchiseBannerController@post_edit_banners', 'as' => 'franchise-request-banners-edit']);
        Route::get('franchise-request-banners-delete/{id}', ['uses' => 'FranchiseBannerController@delete_banners', 'as' => 'franchise-request-banners-delete']);
        
        
        Route::get('franchise-student-list', ['uses' => 'FranchiseStudentController@get_user_list', 'as' => 'franchise-student-list']);
        Route::get('franchise-studentdata-list', ['uses' => 'FranchiseStudentController@get_user_list_datatable', 'as' => 'franchise-studentdata-list']);
        Route::get('franchise_student-edit/{id}', ['uses' => 'FranchiseStudentController@get_edit_user', 'as' => 'franchise_student-edit']);
        Route::put('franchise_student-edit/{id}', ['uses' => 'FranchiseStudentController@post_edit_user', 'as' => 'franchise_student-edit']);
        Route::get('franchise_student-delete/{id}', ['uses' => 'FranchiseStudentController@delete', 'as' => 'franchise_student-delete']);
        Route::get('/franchise-student-assign_course-list/{id}', 'FranchiseStudentController@assign_course_list')->name('franchise-student-assign_course-list');
        Route::get('/franchise-student-assign_course-list/datatables/{id}', 'FranchiseStudentController@assign_course_list_datatables')->name('franchise-student-assign_course-list-datatables');
        Route::get('/franchise-student-i-card/{id}', ['uses' => 'FranchiseStudentController@download_i_card', 'as' => 'franchise-student-i-card']);
    
        
        // for individual franchise students
        Route::get('franchise-student_exam-list/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_list', 'as' => 'franchise-student_exam-list']);
        Route::get('franchise-student_exam-data-list/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_list_datatable', 'as' => 'franchise-student_exam-data-list']);
        Route::get('franchise-student_exam-edit/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_edit', 'as' => 'franchise-student_exam-edit']);
        Route::post('franchise-student_exam-edit/{id}', ['uses' => 'FranchiseStudentController@post_student_exam_edit', 'as' => 'franchise-student_exam-edit']);
        Route::get('franchise-student_exam-view/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_view', 'as' => 'franchise-student_exam-view']);
        Route::get('franchise-student_exam-certificate-download/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_certificate_download', 'as' => 'franchise-student_exam-certificate-download']);
        Route::get('franchise-student_exam-result-download/{id}', ['uses' => 'FranchiseStudentController@get_student_exam_result_download', 'as' => 'franchise-student_exam-result-download']);
        
        
        //for all franchise students
        Route::get('franchise-student-exam/datas', 'FranchiseExamController@datatables')->name('franchise-student-exam-datas'); //JSON REQUEST
        Route::get('franchise-student-exams', 'FranchiseExamController@index')->name('franchise-student-exams');
        
        Route::get('franchise-student-exam-get-edit/{id}', 'FranchiseExamController@get_edit')->name('franchise-student-exam-get-edit');
        Route::post('franchise-student-exam-post-edit/{id}', ['uses' => 'FranchiseExamController@post_edit', 'as' => 'franchise-student-exam-post-edit']);
        
        Route::get('franchise-student-exam-get-view/{id}', 'FranchiseExamController@view')->name('franchise-student-exam-get-view');
        
        Route::get('franchise-exam-certificate-down/{id}', ['uses' => 'FranchiseExamController@exam_certificate_download', 'as' => 'franchise-exam-certificate-down']);
        Route::get('franchise-exam-result-down/{id}', ['uses' => 'FranchiseExamController@exam_result_download', 'as' => 'franchise-exam-result-down']);
        Route::get('/franchise-student-certificate/delivered/{id}', ['uses' => 'FranchiseExamController@exam_certificate_delivered', 'as' => 'franchise-student-exam-certificate-delivered']);
        Route::post('/franchise-student-certificate-delivered/{id}', ['uses' => 'FranchiseExamController@post_exam_certificate_delivered', 'as' => 'franchise-student-certificate-delivered']);
        
        
        
        
        Route::get('franchise-course-list-datatables', 'FranchiseCourseController@datatables')->name('franchise-course-list-datatables'); //JSON REQUEST
        Route::get('franchise-course', 'FranchiseCourseController@index')->name('franchise-course-list-index');
        Route::get('franchise-course/edit/{id}', 'FranchiseCourseController@edit')->name('franchise-course-list-edit');
        Route::post('franchise-course/update/{id}', 'FranchiseCourseController@update')->name('franchise-course-list-update');
        Route::get('franchise-course/delete/{id}', 'FranchiseCourseController@destroy')->name('franchise-course-list-delete');
        
        Route::get('franchise-course-ques-ans/{id}', 'FranchiseCourseController@question_answer')->name('franchise-course-ques-ans'); //* w.r.t. particular course
        Route::get('franchise-course-ques-ans/datatables/{id}', 'FranchiseCourseController@question_answer_datatables')->name('franchise-course-ques-ans-datatables');
        Route::get('franchise-course-ques-ans-edit/{id}', 'FranchiseCourseController@edit_question')->name('franchise-course-ques-ans-edit');
        Route::post('franchise-course-ques-ans-update/{id}', 'FranchiseCourseController@update_question')->name('franchise-course-ques-ans-update');
        Route::get('franchise-course-ques-ans-delete/{id}', 'FranchiseCourseController@destroy_question')->name('franchise-course-ques-ans-delete');
        
        Route::get('franchise-course-module-list/{id}', 'FranchiseCourseController@module')->name('franchise-course-module-list');
        Route::get('franchise-course-module-list-datatables/{id}', 'FranchiseCourseController@module_datatables')->name('franchise-course-module-list-datatables');
        Route::get('franchise-course-module-list-edit/{id}', 'FranchiseCourseController@module_edit')->name('franchise-course-module-list-edit');
        Route::post('franchise-course-module-list-update/{id}', 'FranchiseCourseController@post_module_edit')->name('franchise-course-module-list-update');
        Route::get('franchise-course-module-list-delete/{id}', 'FranchiseCourseController@module_delete')->name('franchise-course-module-list-delete');
        
        
        Route::get('franchise-course-module-video-list/{id}', 'FranchiseCourseController@module_video')->name('franchise-course-module-video-list');
        Route::get('franchise-course-module-video-list-datatables/{id}', 'FranchiseCourseController@module_video_datatables')->name('franchise-course-module-video-list-datatables');
        Route::get('franchise-course-module-video-list-edit/{id}', 'FranchiseCourseController@module_video_edit')->name('franchise-course-module-video-list-edit');
        Route::post('franchise-course-module-video-list-update/{id}', 'FranchiseCourseController@post_module_video_edit')->name('franchise-course-module-video-list-update');
        Route::get('franchise-course-module-video-list-delete/{id}', 'FranchiseCourseController@module_video_delete')->name('franchise-course-module-video-list-delete');
        
        
        
        Route::get('franchise-purchase-elements', ['uses' => 'FranchiseOrderController@get_element_order_list', 'as' => 'franchise-purchase-elements']);
        Route::get('franchise-purchase-element-list-datatable', ['uses' => 'FranchiseOrderController@get_element_order_list_datatable', 'as' => 'franchise-purchase-element-list-datatable']);
        Route::get('franchise-purchase-element-edit/{id}', ['uses' => 'FranchiseOrderController@get_edit_purchase_element', 'as' => 'franchise-purchase-element-edit']);
        Route::put('franchise-purchase-element-edit/{id}', ['uses' => 'FranchiseOrderController@post_edit_purchase_element', 'as' => 'franchise-purchase-element-edit']);
        
        
    });
});
