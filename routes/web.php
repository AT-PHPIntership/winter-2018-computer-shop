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
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function(){
    Route::get('/home', 'AdminController@home')->name('admin.home');
    Route::resource('roles', 'RoleController');
    Route::resource('promotions', 'PromotionController');
    Route::resource('codes', 'CodeController');
    Route::resource('access', 'AccessController');
    Route::resource('orders', 'OrderController');
}); 

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Auth'], function() {
//     Route::get('/login', 'LoginController@showLoginForm')->name('login');
//     Route::post('/login', 'LoginController@login')->name('login');
//     Route::get('/logout', 'LoginController@logout')->name('logout');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
