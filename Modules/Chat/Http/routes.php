<?php

Route::group(['middleware' => 'web', 'prefix' => 'chat', 'namespace' => 'Modules\Chat\Http\Controllers'], function () {
    Route::get('/', 'ChatController@index')->name('chat.index');
});

Route::group(['prefix' => 'messages', 'namespace' => 'Modules\Chat\Http\Controllers'], function () {
    Route::get('/{id}', 'MessageController@index')->name('message.index');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/', 'MessageController@store')->name('message.store');
    });
});

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Chat\Http\Controllers'], function () {
    Route::resource('conversation', 'ConversationController');
});
