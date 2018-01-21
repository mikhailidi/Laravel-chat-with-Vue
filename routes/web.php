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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'friends'], function (){
        Route::get('/', 'FriendController@index')->name('friends.index');
        Route::post('/add/{id}', 'FriendController@store')->name('friends.add');
        Route::post('/delete/{id}', 'FriendController@remove')->name('friends.delete');
    });
    Route::get('/users', 'HomeController@getAllUsers')->name('users.all');
});

