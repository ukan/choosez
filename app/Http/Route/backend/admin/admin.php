<?php

Route::group(['prefix' => 'admin','middleware' => 'AdminAccess', 'namespace' => 'Backend\Admin'], function () {

    Route::get('dashboard/{code?}', array('as' => 'admin-dashboard', 'uses' => 'DashboardController@index'));
    Route::post('dashboard/post', array('as' => 'hq-admin-dashboard-post', 'uses' => 'DashboardController@HqDashboardPost'));
    Route::any('/admin_dashboard_ajax_bulletin_pagination', array('as' => 'admin-dashboard-ajax-pagination-bulletin-board-member', 'uses' => 'DashboardController@AjaxPaginationBulletinBoard'));
    Route::get('profile', array('as' => 'admin-profile', 'uses' => 'ProfileController@index'));
    Route::put('profile/{type}', array('as' => 'admin-profile-update', 'uses' => 'ProfileController@update'));

    Route::get('user-notifications', array('as' => 'admin-user-notifications', 'uses' => 'UserNotificationsController@index'));
    Route::get('send-mail', array('as' => 'admin-send-mail', 'uses' => 'DashboardController@sendEmail'));
    
    Route::post('user-notifications/post', array('as' => 'admin-user-notifications-post', 'uses' => 'UserNotificationsController@post'));

    Route::group(['prefix' => 'user-trustees','namespace' => 'UserTrustee'], function () {

        // Menu Management...
        Route::resource('menus', 'MenuController', ['except' => 'show']);
        Route::delete('menus/{id}/delete', 'MenuController@destroy');

        // Role Management...
        Route::resource('roles', 'RoleController', ['except' => 'show']);

        // User Trustee Management...
        Route::resource('users', 'UserController', ['except' => 'show']);
        Route::delete('users/{id}/delete', 'UserController@delete');
        Route::post('users/{id}/update', 'UserController@updateStatus');

    });

    Route::group(['prefix' => 'users','namespace' => 'userRegister'], function () {

        // User Trustee Management...
        Route::resource('user-register', 'UserRegisterController', ['except' => 'show']);
        Route::delete('users/{id}/delete', 'UserRegisterController@delete');

    });

    Route::group(['prefix' => 'manual','namespace' => 'ManualEdit'], function () {

        // User Trustee Management...
        Route::resource('user-edit', 'ManualController', ['except' => 'show']);
        Route::post('user-edit/{id}/update', array('as' => 'admin-update-user-manual', 'uses' => 'ManualController@update'));

    });

    Route::group(['prefix' => 'master'], function () {

        //route Country
        Route::get('country', array('as' => 'admin-index-country', 'uses' => 'CountriesController@index'));
        Route::get('country/create', array('as' => 'admin-create-country', 'uses' => 'CountriesController@create'));
        Route::post('country/store', array('as' => 'admin-post-country', 'uses' => 'CountriesController@store'));
        Route::get('country/{id}/edit', array('as' => 'admin-edit-country', 'uses' => 'CountriesController@edit'));
        Route::post('country/{id}/update', array('as' => 'admin-update-country', 'uses' => 'CountriesController@update'));
        Route::delete('country/{id}/delete', array('as' => 'admin-delete-country', 'uses' => 'CountriesController@destroy'));

        //route Province
        Route::get('province', array('as' => 'admin-index-province', 'uses' => 'ProvincesController@index'));
        Route::get('province/create', array('as' => 'admin-create-province', 'uses' => 'ProvincesController@create'));
        Route::post('province/store', array('as' => 'admin-post-province', 'uses' => 'ProvincesController@store'));
        Route::get('province/{id}/edit', array('as' => 'admin-edit-province', 'uses' => 'ProvincesController@edit'));
        Route::post('province/{id}/update', array('as' => 'admin-update-province', 'uses' => 'ProvincesController@update'));
        Route::delete('province/{id}/delete', array('as' => 'admin-delete-province', 'uses' => 'ProvincesController@destroy'));

        //route City
        Route::get('city', array('as' => 'admin-index-city', 'uses' => 'CitiesController@index'));
        Route::get('city/create', array('as' => 'admin-create-city', 'uses' => 'CitiesController@create'));
        Route::post('city/store', array('as' => 'admin-post-city', 'uses' => 'CitiesController@store'));
        Route::get('city/{id}/edit', array('as' => 'admin-edit-city', 'uses' => 'CitiesController@edit'));
        Route::post('city/{id}/update', array('as' => 'admin-update-city', 'uses' => 'CitiesController@update'));
        Route::delete('city/{id}/delete', array('as' => 'admin-delete-city', 'uses' => 'CitiesController@destroy'));

        //route Category
        Route::get('category', array('as' => 'admin-index-category', 'uses' => 'CategoriesController@index'));
        Route::get('category/create', array('as' => 'admin-create-category', 'uses' => 'CategoriesController@create'));
        Route::post('category/store', array('as' => 'admin-post-category', 'uses' => 'CategoriesController@store'));
        Route::get('category/{id}/edit', array('as' => 'admin-edit-category', 'uses' => 'CategoriesController@edit'));
        Route::post('category/{id}/update', array('as' => 'admin-update-category', 'uses' => 'CategoriesController@update'));
        Route::delete('category/{id}/delete', array('as' => 'admin-delete-category', 'uses' => 'CategoriesController@destroy'));
        Route::post('category/parent-combo', array('as' => 'list-parent-category', 'uses' => 'CategoriesController@listParentCategory'));

        //route Hastags
        Route::get('hastag', array('as' => 'admin-index-hastag', 'uses' => 'HastagsController@index'));
        Route::post('hastag/store', array('as' => 'admin-post-hastag', 'uses' => 'HastagsController@store'));
        Route::get('hastag/{id}/edit', array('as' => 'admin-edit-hastag', 'uses' => 'HastagsController@edit'));
        Route::post('hastag/{id}/update', array('as' => 'admin-update-hastag', 'uses' => 'HastagsController@update'));
        Route::delete('hastag/{id}/delete', array('as' => 'admin-delete-hastag', 'uses' => 'HastagsController@destroy'));

    });

    Route::group(['prefix' => 'management'], function () {
        //route Users
        Route::get('users', array('as' => 'admin-index-users', 'uses' => 'UsersController@index'));
        Route::get('users/create', array('as' => 'admin-create-users', 'uses' => 'UsersController@create'));
        Route::post('users/store', array('as' => 'admin-post-users', 'uses' => 'UsersController@store'));
        Route::get('users/{id}/edit', array('as' => 'admin-edit-users', 'uses' => 'UsersController@edit'));
        Route::post('users/{id}/update', array('as' => 'admin-update-users', 'uses' => 'UsersController@update'));
        Route::get('users/{id}/delete', array('as' => 'admin-delete-users', 'uses' => 'UsersController@destroy'));
        Route::post('users/{id}/restore', array('as' => 'admin-restore-users', 'uses' => 'UsersController@restore'));
        Route::get('users/{id}/show', array('as' => 'admin-show-users', 'uses' => 'UsersController@show'));

    });

    Route::group(['prefix' => 'lcw-page','namespace' => 'LcwPage'], function () {

        Route::get('manage-lcw', array('as' => 'admin-manage-lcw', 'uses' => 'ManageLcwController@index'));
        Route::post('manage-lcw/store', array('as' => 'admin-post-update-manage-lcw', 'uses' => 'ManageLcwController@store'));
        Route::post('manage-lcw/ajax-get-value-lcw', array('as' => 'admin-post-ajax-get-value-lcw', 'uses' => 'ManageLcwController@ajaxGetValueLcw'));
        /*get_data_member_set_update*/
        Route::post('manage-lcw/get_data_landing_set_update', array('as' => 'get-data-landing-set-update', 'uses' => 'ManageLcwController@get_data_landing_set_update'));
        Route::any('manage-lcw/get-datatable-lcw', array('as' => 'get-datatable-lcw', 'uses' => 'ManageLcwController@datatables'));
        Route::post('manage-lcw/get_data_menu', array('as' => 'admin-get-data-set-update', 'uses' => 'ManageLcwController@get_data_menu_set_update'));
        Route::post('manage-lcw/post_new_menu', array('as' => 'admin-new-menu-post', 'uses' => 'ManageLcwController@post_new_menu'));
        Route::post('manage-lcw/post_edit_menu', array('as' => 'admin-edit-menu-post', 'uses' => 'ManageLcwController@post_edit_menu'));
    });

    Route::group(['prefix' => 'manage-bulletin-board'], function () {
        Route::get('', array('as' => 'admin-index-bulletin-board', 'uses' => 'BulletinBoardsController@index'));
        Route::post('show', array('as' => 'admin-show-bulletin-board', 'uses' => 'BulletinBoardsController@show'));
        Route::post('post_bulletin_board', array('as' => 'admin-post-bulletin-board', 'uses' => 'BulletinBoardsController@post_buletin_board'));
        Route::post('post_publish_bulletin_board', array('as' => 'admin-post-publish-bulletin-board', 'uses' => 'BulletinBoardsController@post_publish'));
        Route::post('get_publish_bulletin_board', array('as' => 'admin-get-publish-bulletin-board', 'uses' => 'BulletinBoardsController@get_data'));
        //Editor
        Route::get('/editor', array('as' => 'admin-index-bulletin-board-editor', 'uses' => 'BulletinBoardsController@indexEditor'));
        Route::post('show-editor', array('as' => 'admin-show-bulletin-board-editor', 'uses' => 'BulletinBoardsController@showEditor'));
        Route::post('post_bulletin_board_editor', array('as' => 'admin-post-bulletin-board-editor', 'uses' => 'BulletinBoardsController@post_buletin_board_editor'));
    });

    Route::group(['prefix' => 'manage-teacher'], function () {
        Route::get('/', array('as' => 'admin-index-teacher', 'uses' => 'TeacherController@index'));
        Route::post('show', array('as' => 'admin-show-teacher', 'uses' => 'TeacherController@show'));
        Route::post('post_teacher', array('as' => 'admin-post-teacher', 'uses' => 'TeacherController@post_teacher'));
        Route::post('post_publish_teacher', array('as' => 'admin-post-publish-teacher', 'uses' => 'TeacherController@post_publish'));
        Route::post('get_publish_teacher', array('as' => 'admin-get-publish-teacher', 'uses' => 'TeacherController@get_data'));
    });

    Route::group(['prefix' => 'academic-management', 'namespace' => 'Academic'], function () {
        Route::get('/books', array('as' => 'admin-index-book', 'uses' => 'BookController@index'));
        Route::post('/books/show', array('as' => 'admin-show-book', 'uses' => 'BookController@show'));
        Route::post('books/post_book', array('as' => 'admin-post-book', 'uses' => 'BookController@post_book'));
    });

    Route::group(['prefix' => 'organization', 'namespace' => 'Organization'], function () {
        /*Kementerian*/
        Route::get('/center/kementerian', array('as' => 'admin-index-pusat-kementerian', 'uses' => 'KementerianController@index'));
        Route::post('/center/kementerian/show', array('as' => 'admin-show-kementerian-pusat', 'uses' => 'KementerianController@show'));
        Route::post('/center/kementerian/post_kementerian', array('as' => 'admin-post-kementerian', 'uses' => 'KementerianController@post_kementerian'));
        /*proker*/
        Route::get('/center/proker', array('as' => 'admin-index-pusat-proker', 'uses' => 'ProkerController@index'));
        Route::post('/center/proker/show', array('as' => 'admin-show-proker-pusat', 'uses' => 'ProkerController@show'));
        Route::post('/center/proker/post_proker', array('as' => 'admin-post-proker', 'uses' => 'ProkerController@post_proker'));
        /*organigram*/
        Route::get('/center/organigram', array('as' => 'admin-index-pusat-organigram', 'uses' => 'OrganigramController@index'));
        Route::post('/center/organigram/show', array('as' => 'admin-show-organigram-pusat', 'uses' => 'OrganigramController@show'));
        Route::post('/center/organigram/post_organigram', array('as' => 'admin-post-organigram', 'uses' => 'OrganigramController@post_organigram'));
    });

    Route::group(['prefix' => 'gallery', 'namespace' => 'Gallery'], function () {
        /*Gallery*/
        Route::get('/album', array('as' => 'admin-index-album', 'uses' => 'GalleryController@index'));
        Route::post('/album/show', array('as' => 'admin-show-album', 'uses' => 'GalleryController@show'));
        Route::post('/album/post_organigram', array('as' => 'admin-post-album', 'uses' => 'GalleryController@post_album'));
        Route::get('/photo', array('as' => 'admin-index-photo', 'uses' => 'GalleryController@indexGallery'));
        Route::post('/photo/post_photo', array('as' => 'admin-post-photo', 'uses' => 'GalleryController@post_photo'));
        Route::post('/photo/show', array('as' => 'admin-show-photo', 'uses' => 'GalleryController@showPhoto'));
    });

    Route::group(['prefix' => 'banner', 'namespace' => 'Banner'], function () {
        /*Banner*/
        Route::get('/', array('as' => 'admin-index-banner', 'uses' => 'BannerController@index'));
        Route::post('/banner/show', array('as' => 'admin-show-banner', 'uses' => 'BannerController@show'));
        Route::post('/banner/post_banner', array('as' => 'admin-post-banner', 'uses' => 'BannerController@post_banner'));
    });

    Route::group(['prefix' => 'slider'], function () {
        /*organigram*/
        Route::get('/', array('as' => 'admin-index-slider', 'uses' => 'SliderController@index'));
        Route::post('/show', array('as' => 'admin-show-slider', 'uses' => 'SliderController@show'));
        Route::post('/post-slider', array('as' => 'admin-post-slider', 'uses' => 'SliderController@post_slider'));
    });

    Route::group(['prefix' => 'bimtes', 'namespace' => 'Bimtes'], function () {
        Route::get('/', array('as' => 'admin-index-bimtes', 'uses' => 'BimtesController@index'));
        Route::post('/show', array('as' => 'admin-show-bimtes', 'uses' => 'BimtesController@show'));
        Route::post('/post-bimtes', array('as' => 'admin-post-bimtes', 'uses' => 'BimtesController@post_bimtes'));
        
        Route::get('/bimtes-register/', array('as' => 'admin-index-bimtes-register', 'uses' => 'BimtesRegisterController@index'));
        Route::post('/bimtes-register/show', array('as' => 'admin-bimtes-register-show-user', 'uses' => 'BimtesRegisterController@showBimtes'));
        Route::post('/get-data-approval', array('as' => 'get-data-approval', 'uses' => 'BimtesRegisterController@get_data_approval'));
        Route::post('change-status', array('as' => 'change-status', 'uses' => 'BimtesRegisterController@change_status'));
        Route::post('/post-bimtes-data', array('as' => 'admin-post-bimtes-data', 'uses' => 'BimtesRegisterController@post_bimtes_data'));

        /*download report*/
        Route::any('/bimtes-register/download/{type}/{from?}/{end?}', 
            array('as' => 'download-data-bimtes', 'uses' =>  'BimtesRegisterController@download'));
    });

    Route::group(['prefix' => 'mos', 'namespace' => 'Mos'], function () {
        Route::get('/', array('as' => 'admin-index-mos', 'uses' => 'MosController@index'));
        Route::post('/show', array('as' => 'admin-mos-show-user', 'uses' => 'MosController@showMos'));
        Route::post('/get-data-approval', array('as' => 'get-data-approval', 'uses' => 'MosController@get_data_approval'));
        Route::post('change-status', array('as' => 'change-status', 'uses' => 'MosController@change_status'));
        Route::post('/post-mos-data', array('as' => 'admin-post-mos-data', 'uses' => 'MosController@post_mos_data'));

        Route::group(['prefix' => 'manual'], function () {
            Route::get('/user-edit', array('as' => 'admin-index-mos-user-edit', 'uses' => 'MosController@resetPassword'));
            Route::post('user-edit/', array('as' => 'admin-update-user-manual', 'uses' => 'MosController@resetPasswordUser'));

        });

        /*download report*/
        Route::any('/download/{type}/{from?}/{end?}', 
            array('as' => 'download-data-mos', 'uses' =>  'MosController@download'));
    });

    Route::group(['prefix' => 'mos/log-history-page','namespace' => 'AuthLogHistory'], function () {
        Route::get('log-history', array('as' => 'admin-view-history-log-mos', 'uses' => 'HistoryLogsController@indexMos'));
        Route::get('log-history-datatable-mos', array('as' => 'admin-view-history-log-datatable-mos', 'uses' => 'HistoryLogsController@datatablesLoginMos'));
    });

    Route::group(['prefix' => 'log-history-page','namespace' => 'AuthLogHistory'], function () {
        Route::get('log-history', array('as' => 'admin-view-history-log', 'uses' => 'HistoryLogsController@index'));
        Route::get('log-history-datatable-login', array('as' => 'admin-view-history-log-datatable-login', 'uses' => 'HistoryLogsController@datatablesLogin'));
    });

    Route::group(['prefix' => 'user-request','namespace' => 'Hq'], function () {
        Route::get('datatables-user-request', array('as' => 'admin-hq-user-request-datatables', 'uses' => 'UserRequestController@datatables'));

        Route::any('post', array('as' => 'admin-hq-user-request-post', 'uses' => 'UserRequestController@post'));

    });

    Route::group(['prefix' => 'suggestion-member', 'namespace' => 'Suggestion'], function () {
        Route::get('/', array('as' => 'suggestion-member', 'uses' => 'SuggestionController@index'));
        Route::post('/show', array('as' => 'admin-show-suggestion', 'uses' => 'SuggestionController@show'));
        Route::post('/post-suggestion', array('as' => 'admin-post-suggestion', 'uses' => 'SuggestionController@post_suggestion'));
    });

    #ministry management
    Route::group(['prefix' => 'ministry', 'namespace' => 'Ministry'], function () {
        Route::group(['prefix' => 'finance'], function () {
            Route::get('/', array('as' => 'finance', 'uses' => 'MinistryOfFinanceController@indexOfFinance'));
            Route::post('show', array('as' => 'admin-show-ministry-of-finance', 'uses' => 'MinistryOfFinanceController@show'));
            Route::post('post_finance', array('as' => 'admin-post-finance', 'uses' => 'MinistryOfFinanceController@post_finance'));
            Route::post('get_data_finance', array('as' => 'admin-get-data-finance', 'uses' => 'MinistryOfFinanceController@get_data'));
            
        });
    });

    #-- Download management
    Route::group(['prefix' => 'download-management', 'namespace' => 'Download'], function () {
        Route::get('/', array('as' => 'admin-index-download', 'uses' => 'DownloadController@index'));
        Route::post('/show', array('as' => 'admin-show-download', 'uses' => 'DownloadController@show'));
        Route::post('/post_download', array('as' => 'admin-post-download', 'uses' => 'DownloadController@post_download'));
    });

    #-- Download Category management
    Route::group(['prefix' => 'download-category-management', 'namespace' => 'DownloadCategory'], function () {
        Route::get('/', array('as' => 'admin-index-download-category', 'uses' => 'DownloadCategoryController@index'));
        Route::post('/post_download_categoty', array('as' => 'admin-post-download-category', 'uses' => 'DownloadCategoryController@post_download_category'));
    });
});

Route::group(['namespace' => 'Frontend'], function () {
    Route::group(['prefix' => 'news'], function () {
        Route::get('news/{id}', array('as' => 'news-detail', 'uses' => 'HomeController@newsDetail'));
    });
});
Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {
    Route::post('country/combo', array('as' => 'list-combo-country', 'uses' => 'CountriesController@comboCountry'));
    Route::get('region/combo', array('as' => 'list-combo-region', 'uses' => 'RegionsController@comboRegion'));
});
