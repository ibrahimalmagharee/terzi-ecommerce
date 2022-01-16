<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Auth::routes();
//Route::group(['namespace' => 'Site', 'middleware' =>'auth:customer', 'prefix' => 'customer'], function (){
//   Route::get('soon','SoonController@soon')->name('customer.soon');
//   Route::get('view-product','SoonController@viewProduct')->name('customer.viewProduct');
//   Route::get('view-product-filter','SoonController@viewProductFilter')->name('customer.viewProductFilter');
//   Route::post('save-design-wishlist','WishlistDesignController@saveDesignWishlist')->name('customer.saveDesignWishlist');
//
//});

Route::group(['namespace' => 'Site', 'middleware' => 'guest:customer', 'prefix' => 'customer'], function(){
    Route::get('/register','CustomerRegisterationController@register')->name('customer.register.page');
    Route::post('/register-customer','CustomerRegisterationController@registerCustomer')->name('customer.register');
    Route::get('/login','CustomerRegisterationController@login')->name('customer.login.page');
    Route::post('/check-login-customer','CustomerRegisterationController@checkLoginCustomer')->name('check.customer.login');

    Route::get('/password/reset','CustomerForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
    Route::get('/password/reset/{token}','CustomerRestPasswordController@showResetForm')->name('customer.password.reset');
    Route::post('/password/email','CustomerForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
    Route::post('/password/reset','CustomerRestPasswordController@reset')->name('customer.password.update');


     ///////////////  View Products Pages /////////////////////

     ///////////////  End View Products Pages /////////////////////

});


Route::group(['namespace' => 'Auth',], function(){

    Route::get('/redirect/{service}', 'LoginController@redirect')->name('service.customer');

    Route::get('/callback/{service}', 'LoginController@callback');

});


