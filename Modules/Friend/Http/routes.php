<?php

Route::group(['middleware' => 'web', 'prefix' => 'friends', 'namespace' => 'Modules\Friend\Http\Controllers'], function()
{
    Route::get('/', 'FriendController@index')->name('friends.index');
    Route::post('/add/{id}', 'FriendController@store')->name('friends.add');
    Route::post('/requests/delete/{id}', 'FriendController@deleteRequest')->name('friends.requests.delete');
    Route::post('/requests/confirm/{id}', 'FriendController@acceptRequest')->name('friends.requests.accept');
});


Route::group(['middleware' => 'web', 'namespace' => 'Modules\Friend\Http\Controllers'], function () {
    Route::get('/friends/search/{keyword}', 'FriendController@search')->name('friends.search');
});
