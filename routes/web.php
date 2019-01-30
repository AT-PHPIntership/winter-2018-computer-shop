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
Route::get('cart', 'PublicController@cart')->name('public.cart');

//Admin Route
Route::group(['prefix' => 'admin'], function(){
    Route::get('/home', 'AdminController@home')->name('admin.home');
    Route::get('/home/excel', 'AdminController@excel')->name('admin.excel');
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
    Route::resource('access', 'AccessController');
    Route::resource('orders', 'OrderController');
    Route::delete('slides/image', 'SlideController@deleteImage');
    Route::resource('slides', 'SlideController');
}); 

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Auth'], function() {
//     Route::get('/login', 'LoginController@showLoginForm')->name('login');
//     Route::post('/login', 'LoginController@login')->name('login');
//     Route::get('/logout', 'LoginController@logout')->name('logout');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
