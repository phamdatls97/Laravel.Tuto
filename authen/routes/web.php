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

/**
 * Route cho admin
 */

Route::prefix('admin')->group(function() {
    //Gom nhóm các route cho phần admin
    Route::get('/','AdminController@index')->name('admin.dashboard');
    //Route đăng nhập thành công
    Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
    //Route trả về view dùng để đăng ký
    Route::get('register','AdminController@create')->name('admin.register');
    //Route post này dùng để đky 1 admin từ form post
    Route::post('register','AdminController@store')->name('admin.register.store');
    //Route trả về view đăng nhập admin
    Route::get('login','Auth\Admin\LoginController@login')->name('admin.auth.login');
    //Route xử lý quá trình đăng nhập admin
    Route::post('login','Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    //Route đăng xuất
    Route::post('logout','Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});

/**
 * Route cho các nhà cung cấp sp
 */
Route::prefix('seller')->group(function(){
    Route::get('/', 'SellerController@index')->name('seller.dashboard');
    //Route đăng nhập thành công
    Route::get('/dashboard','SellerController@index')->name('seller.dashboard');
    //Route trả về view dùng để đăng ký
    Route::get('register','SellerController@create')->name('seller.register');
    //Route post này dùng để đky 1 seller từ form post
    Route::post('register','SellerController@store')->name('seller.register.store');
    //Route trả về view đăng nhập seller
    Route::get('login','Auth\Seller\LoginController@login')->name('seller.auth.login');
    //Route xử lý quá trình đăng nhập seller
    Route::post('login','Auth\Seller\LoginController@loginSeller')->name('seller.auth.loginSeller');
    //Route đăng xuất
    Route::post('logout','Auth\Seller\LoginController@logout')->name('seller.auth.logout');
});

/**
 * Route cho các nhà cung cấp sp
 */
Route::prefix('shipper')->group(function(){
    Route::get('/', 'ShipperController@index')->name('shipper.dashboard');
    //Route đăng nhập thành công
    Route::get('/dashboard','ShipperController@index')->name('shipper.dashboard');
    //Route trả về view dùng để đăng ký
    Route::get('register','ShipperController@create')->name('shipper.register');
    //Route post này dùng để đky 1 admin từ form post
    Route::post('register','ShipperController@store')->name('shipper.register.store');
    //Route trả về view đăng nhập admin
    Route::get('login','Auth\Shipper\LoginController@login')->name('shipper.auth.login');
    //Route xử lý quá trình đăng nhập admin
    Route::post('login','Auth\Shipper\LoginController@loginSeller')->name('shipper.auth.loginShipper');
    //Route đăng xuất
    Route::post('logout','Auth\Shipper\LoginController@logout')->name('shipper.auth.logout');
});