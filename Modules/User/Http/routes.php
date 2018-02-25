<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::group(['prefix' => 'profile'], function (){
        Route::get('/', 'UserController@index')->name('profile.index');
    });

    Route::get('/users', 'UserController@getAllUsers')->name('users.all');
});