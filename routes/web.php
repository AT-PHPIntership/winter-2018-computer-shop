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
    Route::get('/home', 'AdminController@home');
  	Route::get('role/index', 'RoleController@index')->name('role.index');
    Route::get('role/create', 'RoleController@create')->name('role.create');
  	Route::post('role/', 'RoleController@store')->name('role.store');
});