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

Route::group(['namespace' => 'Site', 'middleware' =>'auth:vendor', 'prefix' => 'vendor'], function (){
    Route::get('about-design', 'VendorDesignPageController@about')->name('vendor.aboutDesign');
    Route::get('about-fabric', 'VendorFabricPageController@about')->name('vendor.aboutFabric');
    Route::get('about-both', 'VendorBothPageController@about')->name('vendor.aboutBoth');

    Route::get('profile-design', 'VendorDesignPageController@getProfileDesign')->name('vendor.profileDesign');
    Route::get('profile-fabric', 'VendorFabricPageController@getProfileFabric')->name('vendor.profileFabric');
    Route::get('profile-both', 'VendorBothPageController@getProfileBoth')->name('vendor.profileBoth');

    Route::get('view-products-design', 'VendorDesignPageController@viewProductsDesign')->name('vendor.viewProductsDesign');
    Route::get('view-products-design-details/{design_id}', 'VendorDesignPageController@viewDesignProductDetails')->name('vendor.viewDesignProductDetails');
    Route::get('view-products-fabric', 'VendorFabricPageController@viewProductsFabric')->name('vendor.viewProductsFabric');
    Route::get('view-products-fabric-details/{fabric_id}', 'VendorFabricPageController@viewFabricProductDetails')->name('vendor.viewFabricProductDetails');

    Route::get('profile-design/edit', 'VendorDesignPageController@editAccountDesign')->name('vendor.editAccountDesign');
    Route::post('profile-design/update', 'VendorDesignPageController@updateAccountDesign')->name('vendor.updateAccountDesign');

    Route::get('profile-fabric/edit', 'VendorFabricPageController@editAccountFabric')->name('vendor.editAccountFabric');
    Route::post('profile-fabric/update', 'VendorFabricPageController@updateAccountFabric')->name('vendor.updateAccountFabric');

    Route::get('profile-both/edit', 'VendorBothPageController@editAccountBoth')->name('vendor.editAccountBoth');
    Route::post('profile-both/update', 'VendorBothPageController@updateAccountBoth')->name('vendor.updateAccountBoth');

    Route::get('add-product-design', 'VendorDesignPageController@addProductDesign')->name('vendor.addProductDesign');
    Route::post('save-product-design', 'VendorDesignPageController@saveProductDesign')->name('vendor.saveProductDesign');

    Route::get('add-product-fabric', 'VendorFabricPageController@addProductFabric')->name('vendor.addProductFabric');
    Route::post('save-product-fabric', 'VendorFabricPageController@saveProductFabric')->name('vendor.saveProductFabric');

    Route::post('save-profile-photo-design/{vendor_id}', 'VendorDesignPageController@saveProfilePhotoDesign')->name('vendor.saveProfilePhotoDesign');
    Route::post('save-profile-header-cover-design/{vendor_id}', 'VendorDesignPageController@saveProfileHeaderCoverDesign')->name('vendor.saveProfileHeaderCoverDesign');

    Route::post('save-profile-photo-fabric/{vendor_id}', 'VendorFabricPageController@saveProfilePhotoFabric')->name('vendor.saveProfilePhotoFabric');
    Route::post('save-profile-header-cover-fabric/{vendor_id}', 'VendorFabricPageController@saveProfileHeaderCoverFabric')->name('vendor.saveProfileHeaderCoverFabric');

    Route::post('save-profile-photo-both/{vendor_id}', 'VendorBothPageController@saveProfilePhotoBoth')->name('vendor.saveProfilePhotoBoth');
    Route::post('save-profile-header-cover-both/{vendor_id}', 'VendorBothPageController@saveProfileHeaderCoverBoth')->name('vendor.saveProfileHeaderCoverBoth');

    Route::get('edit-product-design/{id}', 'VendorDesignPageController@editProductDesign')->name('vendor.editProductDesign');
    Route::post('update-product-design/{id}', 'VendorDesignPageController@updateProductDesign')->name('vendor.updateProductDesign');

    Route::get('edit-product-fabric/{id}', 'VendorFabricPageController@editProductFabric')->name('vendor.editProductFabric');
    Route::post('update-product-fabric/{id}', 'VendorFabricPageController@updateProductFabric')->name('vendor.updateProductFabric');

    Route::get('contact-us-design', 'VendorDesignPageController@getContactUsDesign')->name('vendor.contactUsDesign');
    Route::post('save-contact-us-design', 'VendorDesignPageController@saveContactUsDesign')->name('vendor.saveContactUsDesign');

    Route::get('contact-us-fabric', 'VendorFabricPageController@getContactUsFabric')->name('vendor.contactUsFabric');
    Route::post('save-contact-us-fabric', 'VendorFabricPageController@saveContactUsFabric')->name('vendor.saveContactUsFabric');

    Route::get('contact-us-both', 'VendorBothPageController@getContactUsBoth')->name('vendor.contactUsBoth');
    Route::post('save-contact-us-both', 'VendorBothPageController@saveContactUsBoth')->name('vendor.saveContactUsBoth');

    Route::get('search-design', 'VendorDesignPageController@getSearchPageDesign')->name('vendor.getSearchPageDesign');
    Route::get('view-search-design', 'VendorDesignPageController@getSearchDesign')->name('vendor.getSearchDesign');

    Route::get('search-fabric', 'VendorFabricPageController@getSearchPageFabric')->name('vendor.getSearchPageFabric');
    Route::get('view-search-fabric', 'VendorFabricPageController@getSearchFabric')->name('vendor.getSearchFabric');

    Route::get('search-both', 'VendorBothPageController@getSearchPageBoth')->name('vendor.getSearchPageBoth');
    Route::get('view-search-both', 'VendorBothPageController@getSearchBoth')->name('vendor.getSearchBoth');

    Route::get('change-password-design', 'VendorDesignPageController@changePasswordDesign')->name('vendor.changePasswordDesign');
    Route::post('change-password-design', 'VendorDesignPageController@updatePasswordDesign')->name('vendor.updatePasswordDesign');

    Route::get('change-password-fabric', 'VendorFabricPageController@changePasswordFabric')->name('vendor.changePasswordFabric');
    Route::post('change-password-fabric', 'VendorFabricPageController@updatePasswordFabric')->name('vendor.updatePasswordFabric');

    Route::get('change-password-both', 'VendorBothPageController@changePasswordBoth')->name('vendor.changePasswordBoth');
    Route::post('change-password-both', 'VendorBothPageController@updatePasswordBoth')->name('vendor.updatePasswordBoth');

    Route::get('purse-design', 'VendorDesignPageController@purseDesign')->name('vendor.purseDesign');
    Route::get('purse-fabric', 'VendorFabricPageController@purseFabric')->name('vendor.purseFabric');

    Route::get('logout','VendorRegisterationController@logout')->name('vendor.logout');




});

Route::group(['namespace' => 'Site', 'middleware' => 'guest:vendor', 'prefix' => 'vendor'], function(){
    Route::get('/register','VendorRegisterationController@register')->name('vendor.register.page');
    Route::post('/register-vendor','VendorRegisterationController@registerVendor')->name('vendor.register');
    Route::get('/login','VendorRegisterationController@login')->name('vendor.login.page');
    Route::post('/check-login-vendor','VendorRegisterationController@checkLoginVendor')->name('check.vendor.login');

    Route::get('/password/reset','VendorForgotPasswordController@showLinkRequestForm')->name('vendor.password.request');
    Route::get('/password/reset/{token}','VendorRestPasswordController@showResetForm')->name('vendor.password.reset');
    Route::post('/password/email','VendorForgotPasswordController@sendResetLinkEmail')->name('vendor.password.email');
    Route::post('/password/reset','VendorRestPasswordController@reset')->name('vendor.password.update');

});

//Route::group(['namespace' => 'Site',], function(){
//
//    Route::get('vendor/redirect/{service}', 'SocialController@redirect')->name('service.vendor');
//
//    Route::get('vendor/callback/{service}', 'SocialController@callback');
//
//});
