<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/session/{language}', array('as' => 'session', 'uses' => 'HomeController@redis'));

    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::any('/destroy_cookie', array('as' => 'destroy_cookie', 'uses' => 'HomeController@destroy_cookie'));
    
    Route::get('/sign_in', array('as' => 'admin-login-member', 'uses' => 'HomeController@sign_in'));
    Route::get('/sign_up', array('as' => 'sign_up', 'uses' => 'HomeController@sign_up'));
    Route::post('/sign_up', array('as' => 'post-sign-up', 'uses' => 'UsersController@postSignUp'));
    
    Route::get('/reset-password', array('as' => 'reset-password', 'uses' => 'UsersController@resetPassword'));
    Route::post('/process-reset-password', array('as' => 'process-reset-password', 'uses' => 'UsersController@processResetPassword'));
    Route::get('/change-password/{forgot_token}', array('as' => 'change-password', 'uses' => 'UsersController@changePassword'));
    Route::post('/process-change-password/{forgot_token}', array('as' => 'process-change-password', 'uses' => 'UsersController@processChangePassword'));

    Route::get('/location-information/{type?}/{id?}/{id_prov?}', array('as' => 'user-location-information-process', 'uses' => 'UsersController@processLocationInformation'));
    Route::get('/process-activation/{forgot_token}', array('as' => 'process-activation', 'uses' => 'UsersController@processActivation'));

    Route::post('/subscribe', array('as' => 'post-data-subscribe', 'uses' => 'HomeController@subscribe'));
    Route::get('/contact', array('as' => 'contact', 'uses' => 'HomeController@contact'));
    Route::post('/contact/contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@post_contact'));

    Route::group(['prefix' => 'news'], function () {
        Route::get('/{slug}', array('as' => 'news-detail', 'uses' => 'HomeController@newsDetail'));
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/history', array('as' => 'profile-history', 'uses' => 'PesantrenController@indexHistory'));
        Route::get('/structure', array('as' => 'profile-structure', 'uses' => 'PesantrenController@indexStructure'));
        Route::get('/teacher', array('as' => 'profile-teacher', 'uses' => 'PesantrenController@indexTeacher'));
        Route::get('/teacher/{id}', array('as' => 'profile-teacher-detail', 'uses' => 'PesantrenController@teacherDetail'));
        Route::get('/achievement', array('as' => 'profile-achievement', 'uses' => 'PesantrenController@indexAchievement'));
    });

    Route::group(['prefix' => 'organization'], function () {
        Route::get('/center', array('as' => 'organization-center', 'uses' => 'OrganizationController@indexCenter'));
        Route::get('/region', array('as' => 'organization-region', 'uses' => 'OrganizationController@indexRegion'));
        Route::get('/uks', array('as' => 'organization-uks', 'uses' => 'OrganizationController@indexUks'));
    });

    Route::group(['prefix' => 'academic'], function () {
        Route::get('/schedule', array('as' => 'academic-schedule', 'uses' => 'AcademicController@indexSchedule'));
        Route::get('/material', array('as' => 'academic-material', 'uses' => 'AcademicController@indexMaterial'));
    });

    Route::group(['prefix' => 'psb'], function () {
        Route::get('/form', array('as' => 'get-page-psb-info', 'uses' => 'PsbController@index'));
        Route::get('/', array('as' => 'get-page-psb', 'uses' => 'PsbController@psbInfo'));
        Route::post('/post-data-psb', array('as' => 'post-data-psb', 'uses' => 'PsbController@store'));
        Route::get('/form-print', array('as' => 'psb-form-print', 'uses' => 'PsbController@psbPrint'));
    });

    Route::group(['prefix' => 'bimtes'], function () {
        Route::get('/', array('as' => 'get-page-bimtes', 'uses' => 'BimtesController@index'));
        /*Route::post('/post-data-psb', array('as' => 'post-data-psb', 'uses' => 'PsbController@store'));
        Route::get('/form-print', array('as' => 'psb-form-print', 'uses' => 'PsbController@psbPrint'));*/
    });

    Route::group(['prefix' => 'facilities'], function () {
        Route::get('/', array('as' => 'get-page-facilities', 'uses' => 'BimtesController@indexFacilities'));
    });

    Route::group(['middleware' => 'MemberAccess', 'namespace' => 'Member'], function () {
        Route::any('/dashboard/{filter}', array('as' => 'admin-dashboard-filter-member', 'uses' => 'DashboardController@index'));
        Route::any('/dashboard', array('as' => 'admin-dashboard-member', 'uses' => 'DashboardController@index'));
        Route::any('/dashboard_ajax_bulletin_pagination', array('as' => 'admin-dashboard-ajax-pagination-bulletin-board-member', 'uses' => 'DashboardController@ajax_pagination_bulletin_board'));
        Route::get('/dashboard_datatables_orders', array('as' => 'datatables-dashboard-funnel-orders', 'uses' => 'DashboardController@datatables_orders'));

        Route::get('/my-profile', array('as' => 'member-profile', 'uses' => 'ProfileController@index'));

        Route::post('/my-profile/post_profile', array('as' => 'member-profile-post', 'uses' => 'ProfileController@post_profile'));

        Route::post('/my-profile/profile-edit-avatar', array('as' => 'member-profile-profile-edit-avatar-process', 'uses' => 'ProfileController@processEditAvatar'));
        Route::get('/my-profile/profile-edit', array('as' => 'member-profile-profile-edit', 'uses' => 'ProfileController@profileEdit'));
        Route::post('/my-profile/profile-edit', array('as' => 'member-profile-profile-edit-process', 'uses' => 'ProfileController@processProfileEdit'));
        Route::get('/my-profile/profile-edit-bank-account', array('as' => 'member-profile-profile-edit-bank-account', 'uses' => 'ProfileController@profileEditBankAccount'));
        Route::post('/my-profile/profile-edit-bank-account', array('as' => 'member-profile-profile-edit-bank-account-process', 'uses' => 'ProfileController@processProfileEditBankAccount'));
        Route::get('/my-profile/profile-completion', array('as' => 'member-profile-profile-completion', 'uses' => 'ProfileController@profileCompletion'));
        Route::post('/my-profile/profile-completion', array('as' => 'member-profile-profile-completion-process', 'uses' => 'ProfileController@processProfileCompletion'));
        Route::get('/my-profile/change-password', array('as' => 'member-profile-change-password', 'uses' => 'ProfileController@changePassword'));
        Route::post('/my-profile/change-password', array('as' => 'member-profile-change-password-process', 'uses' => 'ProfileController@processChangePassword'));
        Route::post('/my-profile/upload-crop-avatar', array('as' => 'member-profile-upload-crop-avatar', 'uses' => 'ProfileController@UploadAvatar'));

        Route::get('/my-profile/smtp', array('as' => 'member-general-setting-smtp', 'uses' => 'GeneralSettingController@index_smtp'));
        Route::get('/my-profile/datatables_smtp', array('as' => 'datatables-general-setting-smtp', 'uses' => 'GeneralSettingController@DatatablesSmtp'));
        Route::post('/my-profile/post_smtp', array('as' => 'member-general-setting-smtp-post', 'uses' => 'GeneralSettingController@post_smtp'));
    });

    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', array('as' => 'gallery', 'uses' => 'GalleryController@index'));
        Route::get('/{id}', array('as' => 'gallery-detail', 'uses' => 'GalleryController@galleryDetail'));
    });

    Route::get('/subscribe-confirmation/{id}', array('as' => 'subscribe-confirmation', 'uses' => 'HomeController@subscribe_confirmation'));
});

Route::post('/center/proker/show', array('as' => 'general-show-proker-pusat', 'uses' => 'Backend\Admin\Organization\ProkerController@showData'));
Route::post('/region/struktur/show', array('as' => 'general-show-struktur-wilayah', 'uses' => 'Backend\Admin\Organization\ProkerController@showDataWilayah'));