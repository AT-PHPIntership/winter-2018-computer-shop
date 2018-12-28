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
Route::group(['prefix' => 'admin'], function(){
    Route::get('/home', 'AdminController@home')->name('admin.home');
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('create', 'UserController@create')->name('users.create');
        Route::post('/', 'UserController@store')->name('users.store');
    });
    Route::resource('roles', 'RoleController');
});