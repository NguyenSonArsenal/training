<?php

Route::get('admin/login',[
    'as'    => 'admin.login.get',
    'uses'  => 'Backend\Auth\AuthController@showFormLogin'
]);

Route::post('admin/login', [
    'as'    =>  'admin.login.post',
    'uses'  => 'Backend\Auth\AuthController@postLoginAdmin'
]);

Route::group(['prefix' => 'superadmin', 'middleware' => 'IsAdmin'], function () {
    Route::get('/', [
        'as'    =>  'superadmin.home',
        'uses'  =>  'Backend\SuperAdminController@index'
    ]);

    Route::prefix('admin')->group(function () {
        Route::get('/create', [
            'as'    =>  'superadmin.create.admin.get',
            'uses'  =>  'Backend\SuperAdminController@create',
        ]);

        Route::post('/', [
            'as'    =>  'superadmin.store.admin',
            'uses'  =>  'Backend\SuperAdminController@store',
        ]);

        Route::get('/{id}/edit', [
            'as'    =>  'superadmin.edit.admin.get',
            'uses'  =>  'Backend\SuperAdminController@edit',
        ]);

        Route::put('/{id}', [
            'as'    => 'superadmin.update.admin',
            'uses'  => 'Backend\SuperAdminController@update',
        ]);

        Route::DELETE('/{id}', [
            'as'    => 'superadmin.delete.admin',
            'uses'  => 'Backend\SuperAdminController@destroy',
        ]);

        Route::get('/js', [
            'as' => 'superadmin.js',
            'uses' => 'Backend\SuperAdminController@js'
        ]);
    });

    Route::get('/logout', [
        'as' => 'admin.logout.get',
        'uses' => 'Backend\Auth\AuthController@logout'
    ]);
});

Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
    Route::get('/', [
        'as'    => 'admin.home',
        'uses'  => 'Backend\AdminController@index'
    ]);

    Route::get('/{id}/edit', [
        'as'    => 'admin.edit.get',
        'uses'  => 'Backend\AdminController@editInfoAdmin'
    ]);

    Route::put('/{id}', [
        'as'    => 'admin.update.admin',
        'uses'  => 'Backend\AdminController@update',
    ]);
});


