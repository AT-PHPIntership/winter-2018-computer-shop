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
    Route::get('users/data', 'UserController@getData');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::get('categories/sub-category', 'CategoryController@getChildren');
    Route::get('categories/data', 'CategoryController@getData');
    Route::resource('categories', 'CategoryController');
    Route::get('products/data', 'ProductController@getData');
    Route::delete('products/image', 'ProductController@deleteImage');
    Route::resource('products', 'ProductController');
    Route::resource('promotions', 'PromotionController');
    Route::resource('codes', 'CodeController');
}); 
