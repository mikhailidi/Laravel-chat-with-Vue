<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'web', 'prefix' => 'chat', 'namespace' => 'Modules\Chat\Http\Controllers'], function() {
    Route::get('/', 'ChatController@index')->name('chat.index');
});

Route::group(['prefix' => 'messages', 'namespace' => 'Modules\Chat\Http\Controllers'], function() {
    Route::get('/', 'MessageController@index')->name('message.index');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'MessageController@store')->name('message.store');
    });
});
