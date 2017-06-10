<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Admin'], function () {

    Route::group(['prefix' => 'datatables'], function () {
        Route::get('directories', 'DirectoryController@datatables');
        Route::get('hashtags/{type}', 'HashtagController@datatables');
        Route::get('roles', 'UserTrustee\RoleController@datatables');
        Route::get('user-trustees', array('as' => 'datatables-user-trustees', 'uses' =>'UserTrustee\UserController@datatables'));

        Route::get('user-register', array('as' => 'datatables-user-register', 'uses' =>'userRegister\UserRegisterController@datatables'));
        Route::get('manual-user-register', array('as' => 'datatables-manual-user-register', 'uses' =>'ManualEdit\ManualController@datatables'));
        Route::get('bimtes', array('as' => 'datatables-bimtes-register', 'uses' =>'Bimtes\BimtesRegisterController@datatables'));
        
        Route::get('menu', 'UserTrustee\MenuController@datatables');
        Route::get('country', array('as' => 'datatables-country', 'uses' => 'CountriesController@datatables'));
        Route::get('province', array('as' => 'datatables-province', 'uses' => 'ProvincesController@datatables'));
        Route::get('city', array('as' => 'datatables-city', 'uses' => 'CitiesController@datatables'));
        Route::get('category', array('as' => 'datatables-category', 'uses' => 'CategoriesController@datatables'));
        Route::get('hastag', array('as' => 'datatables-hastag', 'uses' => 'HastagsController@datatables'));

        Route::get('application', array('as' => 'datatables-application', 'uses' => 'ApplicationController@datatables'));

        Route::get('district', array('as' => 'datatables-district', 'uses' => 'DistrictsController@datatables'));

        Route::get('village', array('as' => 'datatables-village', 'uses' => 'VillagesController@datatables'));

        Route::get('branch', array('as' => 'datatables-branch', 'uses' => 'BranchController@datatables'));

        Route::get('venue', array('as' => 'datatables-venue', 'uses' => 'VenuesController@datatables'));
        Route::get('event', array('as' => 'datatables-event', 'uses' => 'EventsController@datatables'));
        

        Route::get('bulletin-boards', array('as' => 'datatables-bulletin-boards', 'uses' => 'BulletinBoardsController@datatables'));
        Route::get('bulletin-boards-editor', array('as' => 'datatables-bulletin-boards-editor', 'uses' => 'BulletinBoardsController@datatablesEditor'));

        Route::get('teacher', array('as' => 'datatables-teacher', 'uses' => 'TeacherController@datatables'));

        Route::get('book', array('as' => 'datatables-book', 'uses' => 'Academic\BookController@datatables'));

        //organization management
        /*kementerian*/
        Route::get('center/kementerian', array('as' => 'datatables-ministry', 'uses' => 'Organization\KementerianController@datatables'));
        /*proker*/
        Route::get('center/proker', array('as' => 'datatables-proker', 'uses' => 'Organization\ProkerController@datatables'));
        /*organigram*/
        Route::get('center/organigram', array('as' => 'datatables-organigram', 'uses' => 'Organization\OrganigramController@datatables'));
        /*album*/
        Route::get('album', array('as' => 'datatables-album', 'uses' => 'Gallery\GalleryController@datatables'));
        Route::get('photo', array('as' => 'datatables-photo', 'uses' => 'Gallery\GalleryController@datatablesGallery'));
        /*slider*/
        Route::get('slider', array('as' => 'datatables-slider', 'uses' => 'SliderController@datatables'));

        Route::get('tags', array('as' => 'datatables-tags', 'uses' => 'ManageFunnel\TagsController@datatables'));
        Route::get('options', array('as' => 'datatables-options', 'uses' => 'ManageFrontend\OptionsController@datatables'));

        Route::get('autoresponse-emails', array('as' => 'datatables-autoresponse-emails', 'uses' => 'MessageCenter\AutoresponseEmailsController@datatables'));
        Route::get('datatables-hq-dashboard-hall-of-fame/{code?}/{year?}', array('as' => 'datatables-hq-dashboard-hall-of-fame', 'uses' => 'DashboardController@DatatablesHqDashboardHallOfFame'));    
        Route::get('datatables-hq-dashboard-order/{code?}/{start_date?}/{end_date?}', array('as' => 'datatables-hq-dashboard-order', 'uses' => 'DashboardController@DatatablesHqDashboardOrder'));   
        Route::get('datatables-hq-dashboard-withdrawal-request', array('as' => 'datatables-hq-dashboard-withdrawal-request', 'uses' => 'DashboardController@DatatablesHqDashboardWithdrawalRequest'));   

        Route::get('user-notifications', array('as' => 'admin-datatables-user-notifications', 'uses' => 'UserNotificationsController@datatables'));
        
        //bimtes management
        Route::get('bimtes-datatable', array('as' => 'datatables-bimtes', 'uses' => 'Bimtes\BimtesController@datatables'));
    });

});
