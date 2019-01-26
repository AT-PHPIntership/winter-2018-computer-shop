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
//Public route
Route::get('/', 'PublicController@homepage');
Route::get('category', 'PublicController@allCategory')->name('public.allCategory');
Route::get('category/{category}', 'PublicController@category')->name('public.category');
Route::get('product/{product}', 'PublicController@getProduct')->name('public.product');
Route::get('product/related/{category}', 'PublicController@getRelated');
Route::get('compare/{first}/{second}', 'PublicController@compare');

    

//Admin Route
Route::group(['prefix' => 'admin'], function(){
    Route::get('/home', 'AdminController@home')->name('admin.home');
    Route::get('users/data', 'UserController@getData');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::get('categories/sub-category', 'CategoryController@getChildren');
    Route::get('categories/data', 'CategoryController@getData');
    Route::resource('categories', 'CategoryController');
    Route::get('products/import', 'ProductController@import');
    Route::post('products/import', 'ProductController@handleImport')->name('products.import');
    Route::get('products/data', 'ProductController@getData');
    Route::delete('products/image', 'ProductController@deleteImage');
    Route::resource('products', 'ProductController');
    Route::resource('promotions', 'PromotionController');
    Route::resource('codes', 'CodeController');
    Route::delete('slides/image', 'SlideController@deleteImage');
    Route::resource('slides', 'SlideController');
}); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Register route
Route::get('register', 'Auth\RegisterController@register')->name('public.register');
Route::post('register', 'Auth\RegisterController@handleRegister')->name('public.register');
Route::get('activation/{token}', 'Auth\RegisterController@activation');

//Login route
Route::get('login', 'Auth\LoginController@login')->name('public.login');
