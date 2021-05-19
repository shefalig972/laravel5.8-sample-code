<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1'], function(){

    

    Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
        Route::get('login', 'AuthController@login')->name('login');
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
        Route::get('me', 'AuthController@me');
    });

    Route::group(['middleware' => 'auth:api','prefix' => 'contact' ,'namespace' => 'Api\User'], function(){
        Route::post('/create', 'ContactController@create')->name('create-contact');
        Route::get('/view', 'ContactController@view')->name('view-contact');
        Route::post('/list', 'ContactController@list')->name('list-contact');
        Route::post('/delete', 'ContactController@delete')->name('delete-contact');
        Route::post('/update', 'ContactController@update')->name('list-contact');
        Route::post('/import', 'ContactController@import')->name('import-contact');
    });

});
