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
Route::get('/', 'PublicController@homepage')->name('public.home');
Route::get('category', 'PublicController@allCategory')->name('public.allCategory');
Route::get('category/{category}', 'PublicController@category')->name('public.category');
Route::post('product/comment', 'PublicController@productComment');
Route::post('product/reply', 'PublicController@productReply');
Route::get('product/search', 'PublicController@productSearch')->name('product.search');
Route::get('product/filter', 'PublicController@productFilter')->name('product.filter');
Route::get('product/sort', 'PublicController@productSort')->name('product.sort');
Route::get('product/{product}', 'PublicController@getProduct')->name('public.product');
Route::get('product/related/{category}', 'PublicController@getRelated');
Route::get('compare/{first}/{second}', 'PublicController@compare');
Route::get('cart', 'PublicController@cart')->name('public.cart');

//User route
Route::group(['prefix' => 'user', 'middleware' => 'user.login'], function () {
    Route::get('checkout/{amount}/{codeId}', 'PublicController@checkout')->name('public.checkout');
    Route::get('infor/order', 'PublicController@inforOder')->name('public.infor.order');

    Route::post('order/create', 'OrderController@createOrder')->name('public.order');
    Route::post('code', 'CodeController@applyCode')->name('public.code');
    Route::get('profile', 'UserController@userProfile')->name('user.profile');
    Route::put('profile/{user}', 'UserController@updateProfile')->name('user.update.profile');
    Route::put('password/{user}', 'UserController@updatePassword')->name('user.update.password');
    Route::delete('order/{order}', 'UserController@deleteOrder')->name('user.delete.order');
});

//Admin route
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
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
    Route::post('promotions/search', 'PromotionController@search');
    Route::resource('codes', 'CodeController');
    Route::delete('slides/image', 'SlideController@deleteImage');
    Route::resource('slides', 'SlideController');
    Route::resource('accessories', 'AccessoryController');
    Route::delete('slides/image', 'SlideController@deleteImage');
    Route::resource('slides', 'SlideController');
    Route::resource('orders', 'OrderController');
    Route::resource('comments', 'CommentController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Register route
Route::get('register', 'Auth\RegisterController@register')->name('public.register');
Route::post('register', 'Auth\RegisterController@handleRegister')->name('public.register');
Route::get('activation/{token}', 'Auth\RegisterController@activation');

//Public login route
Route::get('login', 'Auth\LoginController@login')->name('public.login');
Route::post('login', 'Auth\LoginController@handleLogin')->name('public.login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Login by Social account
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
