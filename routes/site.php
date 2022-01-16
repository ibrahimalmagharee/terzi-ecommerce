<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function(){
    Route::get('/','LandingPageController@index')->name('index');
    Route::get('/about','LandingPageController@aboutLanding')->name('aboutLanding');
    Route::get('/usage-policy','LandingPageController@usagePolicy')->name('usagePolicy');
    Route::get('/term-condition','LandingPageController@termCondition')->name('termCondition');

    Route::get('view-design-product','CustomerDesignPagesController@viewDesignProduct')->name('customer.viewDesignProduct');
    Route::get('view-design-product-filter','CustomerDesignPagesController@viewDesignProductFilter')->name('customer.viewDesignProductFilter');
    Route::get('view-design-product-details/{design_id}','CustomerDesignPagesController@viewDesignProductDetails')->name('customer.viewDesignProductDetails');

    Route::get('view-fabric-product','CustomerFabricPagesController@viewFabricProduct')->name('customer.viewFabricProduct');
    Route::get('view-fabric-product-filter','CustomerFabricPagesController@viewFabricProductFilter')->name('customer.viewFabricProductFilter');
    Route::get('view-fabric-product-details/{fabric_id}','CustomerFabricPagesController@viewFabricProductDetails')->name('customer.viewFabricProductDetails');

    Route::get('company-profile/{vendor_id}','CompanyController@companyProfile')->name('customer.companyProfile');
    Route::get('companies','CompanyController@viewCompanies')->name('customer.viewCompanies');

    Route::get('/contactUs','LandingPageController@contactUs')->name('contactUs');
    Route::post('save-contact-us', 'LandingPageController@saveContactUs')->name('customer.saveContactUs');

    Route::get('wishlist/products', 'ProductWishlistController@index')->name('wishlist.products.index');

    Route::get('basket/products', 'BasketProductController@index')->name('basket.products.index');

    Route::get('sizes', 'SizeController@index')->name('customer.sizes');

    Route::get('search', 'SearchController@getSearchPage')->name('customer.getSearchPage');
    Route::get('view-search', 'SearchController@getSearch')->name('customer.getSearch');

    Route::post('logout','CustomerRegisterationController@logout')->name('customer.logout');

});

Route::group(['namespace' => 'Site', 'middleware' =>'auth:customer'], function (){
    Route::post('save-product-wishlist','ProductWishlistController@saveProductWishlist')->name('customer.saveProductWishlist');
    Route::delete('delete-product-wishlist', 'ProductWishlistController@destroy')->name('ProductWishlist.destroy');

    //////////////////// Basket Routes /////////////////////////

    Route::post('save-product-basket','BasketProductController@saveProductBasket')->name('customer.saveProductBasket');
    Route::delete('delete-product-basket', 'BasketProductController@destroy')->name('ProductBasket.destroy');
    Route::post('/status/update', 'BasketProductController@updateStatus')->name('update.status');

    Route::post('/size/update', 'BasketProductController@updateSize')->name('select.size');
    Route::post('/size/add', 'BasketProductController@addSize')->name('add.size');
    Route::post('edit', 'SizeController@edit')->name('edit.size');
    Route::post('update', 'SizeController@update')->name('update.size');
    Route::post('delete', 'SizeController@destroy')->name('delete.size');


    //////////////////// Basket Routes /////////////////////////


    //////////////////// Shipping Routes /////////////////////////

    Route::post('shipping', 'CartController@shipping')->name('customer.shipping');

    //////////////////// Shipping Routes /////////////////////////


    ////////////////// Cart Routes //////////////////////////


    Route::get('cart', 'CartController@getCartPage')->name('customer.getCartPage');
    Route::delete('delete-product', 'CartController@destroy')->name('Product.destroy');

    Route::post('update-product-quantity', 'CartController@updateQuantity')->name('Product.update.quantity');

    Route::post('update-product-meters', 'CartController@updateNumberOfMeters')->name('Product.update.meters');

    Route::post('check-coupon', 'CartController@checkCoupon')->name('Product.checkCoupon');

    Route::post('payment', 'CartController@payment')->name('customer.payment');

    Route::get('cart', 'CartController@getCartPage')->name('customer.getCartPage');
    //Route::get('test-payment', 'CartController@getTestPayment')->name('customer.getCartTestPage');


    ////////////////// Cart Routes //////////////////////////


});
Route::get('stripe', 'HomeController@stripe');
Route::post('stripe', 'HomeController@stripePost')->name('stripe.post');
Route::get('my-purchases', 'Site\MyPurchasesController@getMyPurchases')->name('customer.getMyPurchases');
