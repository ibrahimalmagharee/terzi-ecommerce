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

Route::group(['namespace' => 'Dashboard', 'middleware' =>'auth:admin'], function (){

    Route::get('index','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','LoginController@logout')->name('admin.logout');

    ######################### Purchase Routes ############################################################

    Route::group(['prefix' => 'purchase', 'middleware' => 'can:purchase'], function (){
        Route::get('fabric', 'PurchaseController@purchaseFabric')->name('purchase.fabric');
        Route::get('design', 'PurchaseController@purchaseDesign')->name('purchase.design');
        Route::get('design-filter', 'PurchaseController@purchaseDesignFilter')->name('purchase.design.filter');
    });

    ######################### End Purchase Routes ########################################################

    ######################### Edit Profile Routes ############################################################

    Route::group(['prefix' => 'profile'], function (){
        Route::get('edit', 'ProfileController@edit')->name('edit.profile');
        Route::put('update', 'ProfileController@update')->name('update.profile');
    });

    ######################### End Edit Profile Routes ########################################################


    ######################### Vendor Routes ########################################################

    Route::group(['prefix' => 'vendor', 'middleware' => 'can:vendor'], function (){
        Route::get('/show-vendors', 'VendorController@index')->name('index.vendors');
        Route::post('save', 'VendorController@store')->name('save.vendor');
        Route::get('edit/{id}', 'VendorController@edit')->name('edit.vendor');
        Route::post('change-password', 'VendorController@changePassword')->name('change.password.vendor');
        Route::post('update/{id}', 'VendorController@update')->name('update.vendor');
        Route::get('delete/{id}', 'VendorController@destroy')->name('delete.vendor');

        //////////// Contact Us ////////////
        Route::get('/show-contact-us', 'ContactUsController@contactUs')->name('index.contactUs.vendors');
        Route::get('/contact-us/delete/{id}', 'ContactUsController@destroyContactUs')->name('delete.contactUs.vendor');

        ////////////////// About Vendor Routes ////////////////////////////////////////

        Route::get('/show-aboutVendors', 'AboutVendorController@index')->name('index.about.vendors');
        Route::post('/about/save', 'AboutVendorController@store')->name('save.about.vendor');
        Route::get('/about/edit/{id}', 'AboutVendorController@edit')->name('edit.about.vendor');
        Route::post('/about/update/{id}', 'AboutVendorController@update')->name('update.about.vendor');
        Route::get('/about/delete/{id}', 'AboutVendorController@destroy')->name('delete.about.vendor');





        ////////////////// End About Vendor Routes ////////////////////////////////////

        ////////////////// Logo Vendor Routes ////////////////////////////////////////

        Route::get('/show-logo', 'LogoVendorController@index')->name('index.logo.vendors');
        Route::post('/logo/save', 'LogoVendorController@store')->name('save.logo.vendor');
        Route::get('/logo/edit/{id}', 'LogoVendorController@edit')->name('edit.logo.vendor');
        Route::post('/logo/update/{id}', 'LogoVendorController@update')->name('update.logo.vendor');
        Route::get('/logo/delete/{id}', 'LogoVendorController@destroy')->name('delete.logo.vendor');





        ////////////////// End Logo Vendor Routes ////////////////////////////////////

    });
    ######################### End Vendor Routes ########################################################

    #########################  Site Index Page Routes ########################################################
    Route::group(['prefix' => 'header-index'], function (){
        Route::get('/show', 'HeaderIndexController@index')->name('index.header_index');
        Route::post('/save', 'HeaderIndexController@store')->name('save.header_index');
        Route::get('/edit/{id}', 'HeaderIndexController@edit')->name('edit.header_index');
        Route::post('/update/{id}', 'HeaderIndexController@update')->name('update.header_index');
        Route::get('/delete/{id}', 'HeaderIndexController@destroy')->name('delete.header_index');
    });

    Route::group(['prefix' => 'header-bottom'], function (){
        Route::get('/show', 'HeaderBottomIndexController@index')->name('index.header_bottom');
        Route::post('/save', 'HeaderBottomIndexController@store')->name('save.header_bottom');
        Route::get('/edit/{id}', 'HeaderBottomIndexController@edit')->name('edit.header_bottom');
        Route::post('/update/{id}', 'HeaderBottomIndexController@update')->name('update.header_bottom');
        Route::get('/delete/{id}', 'HeaderBottomIndexController@destroy')->name('delete.header_bottom');
    });

    Route::group(['prefix' => 'fabric-slider'], function (){
        Route::get('/show', 'FabricSliderIndexController@index')->name('index.fabric_slider');
        Route::post('/save', 'FabricSliderIndexController@store')->name('save.fabric_slider');
        Route::get('/edit/{id}', 'FabricSliderIndexController@edit')->name('edit.fabric_slider');
        Route::post('/update/{id}', 'FabricSliderIndexController@update')->name('update.fabric_slider');
        Route::get('/delete/{id}', 'FabricSliderIndexController@destroy')->name('delete.fabric_slider');
    });

    Route::group(['prefix' => 'content-center-design'], function (){
        Route::get('/show', 'ContentCenterDesignIndexController@index')->name('index.content_center_design');
        Route::post('/save', 'ContentCenterDesignIndexController@store')->name('save.content_center_design');
        Route::get('/edit/{id}', 'ContentCenterDesignIndexController@edit')->name('edit.content_center_design');
        Route::post('/update/{id}', 'ContentCenterDesignIndexController@update')->name('update.content_center_design');
        Route::get('/delete/{id}', 'ContentCenterDesignIndexController@destroy')->name('delete.content_center_design');
    });
    ######################### End Site Index Page Routes ########################################################

    #########################  Users Dashboard Routes ########################################################
    Route::group(['prefix' => 'users', 'middleware' => 'can:users'], function (){
        Route::get('/show', 'UsersDashboardController@index')->name('index.users');
        Route::post('/save', 'UsersDashboardController@store')->name('save.user');
        Route::get('/edit/{id}', 'UsersDashboardController@edit')->name('edit.user');
        Route::post('/update/{id}', 'UsersDashboardController@update')->name('update.user');
        Route::get('/delete/{id}', 'UsersDashboardController@destroy')->name('delete.user');
    });
    ######################### End Users Dashboard Routes ########################################################

    #########################  Roles Routes ########################################################
    Route::group(['prefix' => 'roles', 'middleware' => 'can:roles'], function (){
        Route::get('/show', 'RoleController@index')->name('index.roles');
        Route::post('/save', 'RoleController@store')->name('save.role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit.role');
        Route::post('/update/{id}', 'RoleController@update')->name('update.role');
        Route::get('/delete/{id}', 'RoleController@destroy')->name('delete.role');
    });
    ######################### End Roles Routes ########################################################

    #########################  About Us Routes ########################################################
    Route::group(['prefix' => 'about-us', 'middleware' => 'can:about-us'], function (){
        Route::get('/show', 'AboutUsController@index')->name('index.about');
        Route::post('/save', 'AboutUsController@store')->name('save.about');
        Route::get('/edit/{id}', 'AboutUsController@edit')->name('edit.about');
        Route::post('/update/{id}', 'AboutUsController@update')->name('update.about');
        Route::get('/delete/{id}', 'AboutUsController@destroy')->name('delete.about');
    });
    ######################### End About Us Routes ########################################################

    ######################### Customer Routes ########################################################

    Route::group(['prefix' => 'customer', 'middleware' => 'can:customer'], function (){
        Route::get('/show-customers', 'CustomerController@index')->name('index.customers');
        Route::post('save', 'CustomerController@store')->name('save.customer');
        Route::get('edit/{id}', 'CustomerController@edit')->name('edit.customer');
        Route::post('update/{id}', 'CustomerController@update')->name('update.customer');
        Route::get('delete/{id}', 'CustomerController@destroy')->name('delete.customer');

        Route::get('/show-contact-us', 'ContactUsCustomerController@contactUs')->name('index.contactUs.customers');
        Route::get('/contact-us/delete/{id}', 'ContactUsCustomerController@destroyContactUs')->name('delete.contactUs.customer');

        Route::group(['prefix' => 'size'], function (){
            Route::get('show-sizes/{customer_id}', 'SizeController@index')->name('size.customer.index');
            Route::post('save', 'SizeController@store')->name('size.save.customer');
            Route::get('edit/{id}', 'SizeController@edit')->name('size.edit.customer');
            Route::post('update/{id}', 'SizeController@update')->name('size.update.customer');
            Route::post('delete', 'SizeController@destroy')->name('size.delete.customer');
        });
    });
    ######################### End Customer Routes ########################################################

    ##################  Category Routes #############################################################

    Route::group(['prefix' => 'category', 'middleware' => 'can:category'], function (){
        Route::get('/show-categories', 'CategoryController@index')->name('index.categories');
        Route::post('save', 'CategoryController@store')->name('save.category');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit.category');
        Route::post('update/{id}', 'CategoryController@update')->name('update.category');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('delete.category');
    });
    ######################### End Category Routes ############################################################

    ##################  Type Routes #############################################################

    Route::group(['prefix' => 'type', 'middleware' => 'can:type'], function (){
        Route::get('/show-types', 'TypeController@index')->name('index.types');
        Route::post('save', 'TypeController@store')->name('save.type');
        Route::get('edit/{id}', 'TypeController@edit')->name('edit.type');
        Route::post('update/{id}', 'TypeController@update')->name('update.type');
        Route::get('delete/{id}', 'TypeController@destroy')->name('delete.type');
    });
    ######################### End Type Routes ############################################################

    ##################  Color Routes #############################################################

    Route::group(['prefix' => 'color', 'middleware' => 'can:color'], function (){
        Route::get('/show-colors', 'ColorController@index')->name('index.colors');
        Route::post('save', 'ColorController@store')->name('save.color');
        Route::get('edit/{id}', 'ColorController@edit')->name('edit.color');
        Route::post('update/{id}', 'ColorController@update')->name('update.color');
        Route::get('delete/{id}', 'ColorController@destroy')->name('delete.color');
    });
    ######################### End Color Routes ############################################################

    ##################  Copon Routes #############################################################

    Route::group(['prefix' => 'coupon', 'middleware' => 'can:coupon'], function (){
        Route::get('/show-coupons', 'CouponController@index')->name('index.coupons');
        Route::post('save', 'CouponController@store')->name('save.coupon');
        Route::get('edit/{id}', 'CouponController@edit')->name('edit.coupon');
        Route::post('update/{id}', 'CouponController@update')->name('update.coupon');
        Route::post('status/update', 'CouponController@updateStatus')->name('updateStatus.coupon');
        Route::get('delete/{id}', 'CouponController@destroy')->name('delete.coupon');
    });
    ######################### End Copon Routes ############################################################

    ##################  Product Routes #############################################################

    Route::group(['prefix' => 'product',  'middleware' => 'can:product'], function (){
        Route::group(['prefix' => 'design', 'middleware' => 'can:design'], function (){
            Route::get('/show-designs', 'DesignController@index')->name('index.designs');
            Route::post('save', 'DesignController@store')->name('save.design');
            Route::get('edit/{id}', 'DesignController@edit')->name('edit.design');
            Route::post('update/{id}', 'DesignController@update')->name('update.design');
            Route::post('change-status', 'DesignController@changeStatus')->name('changeStatus.design');
            Route::get('delete/{id}', 'DesignController@destroy')->name('delete.design');
            Route::post('save-images-inFolder', 'DesignController@saveImagesOfDesignInFolder')->name('save.images.design.inFolder');
            Route::post('remove-image', 'DesignController@removeImagesOfDesignFromFolder')->name('delete.image.design.fromFolder');
        });

        Route::group(['prefix' => 'fabric', 'middleware' => 'can:fabric'], function (){
            Route::get('/show-fabrics', 'FabricController@index')->name('index.fabrics');
            Route::post('save', 'FabricController@store')->name('save.fabric');
            Route::get('edit/{id}', 'FabricController@edit')->name('edit.fabric');
            Route::post('update/{id}', 'FabricController@update')->name('update.fabric');
            Route::get('delete/{id}', 'FabricController@destroy')->name('delete.fabric');
            Route::post('save-images-inFolder', 'FabricController@saveImagesOfDesignInFolder')->name('save.images.fabric.inFolder');
            Route::post('remove-image', 'FabricController@removeImagesOfDesignFromFolder')->name('delete.image.fabric.fromFolder');
        });
    });
    ######################### End Product Routes ############################################################

    #########################  Social Media Link Dashboard Routes ########################################################
    Route::group(['prefix' => 'social-media-link', 'middleware' => 'can:social_media_link'], function (){
        Route::get('/show', 'SocialMediaLinkController@index')->name('index.social_media_link');
        Route::get('/edit/{id}', 'SocialMediaLinkController@edit')->name('edit.social_media_link');
        Route::post('/update/{id}', 'SocialMediaLinkController@update')->name('update.social_media_link');
        Route::get('/delete/{id}', 'SocialMediaLinkController@destroy')->name('delete.social_media_link');
    });
    ######################### End Social Media Link Dashboard Routes ########################################################


    #########################  Terms And Conditions Dashboard Routes ########################################################
    Route::group(['prefix' => 'term-condition', 'middleware' => 'can:term_condition'], function (){
        Route::get('/show', 'TermsAndConditionsController@index')->name('index.term_condition');
        Route::post('/save', 'TermsAndConditionsController@store')->name('save.term_condition');
        Route::get('/edit/{id}', 'TermsAndConditionsController@edit')->name('edit.term_condition');
        Route::post('/update/{id}', 'TermsAndConditionsController@update')->name('update.term_condition');
        Route::post('/view', 'TermsAndConditionsController@viewTermsAndConditions')->name('view.TermsAndConditions');
        Route::get('/delete/{id}', 'TermsAndConditionsController@destroy')->name('delete.term_condition');
    });
    ######################### End Terms And Conditions Dashboard Routes ########################################################


    #########################  Usage Policy Dashboard Routes ########################################################
    Route::group(['prefix' => 'usage-policy', 'middleware' => 'can:usage_policy'], function (){
        Route::get('/show', 'UsagePolicyController@index')->name('index.usage_policy');
        Route::post('/save', 'UsagePolicyController@store')->name('save.usage_policy');
        Route::get('/edit/{id}', 'UsagePolicyController@edit')->name('edit.usage_policy');
        Route::post('/update/{id}', 'UsagePolicyController@update')->name('update.usage_policy');
        Route::post('/view', 'UsagePolicyController@viewUsagePolicy')->name('view.UsagePolicy');
        Route::get('/delete/{id}', 'UsagePolicyController@destroy')->name('delete.usage_policy');
    });
    ######################### End Usage Policy Dashboard Routes ########################################################

    #########################  Logo Dashboard Routes ########################################################
    Route::group(['prefix' => 'logo', 'middleware' => 'can:logo'], function (){
        Route::get('/show', 'LogoController@index')->name('index.logo');
        Route::post('/save', 'LogoController@store')->name('save.logo');
        Route::get('/edit/{id}', 'LogoController@edit')->name('edit.logo');
        Route::post('/update/{id}', 'LogoController@update')->name('update.logo');
        Route::get('/delete/{id}', 'LogoController@destroy')->name('delete.logo');
    });
    ######################### End Logo Dashboard Routes ########################################################

});

Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin'], function(){
    Route::get('/login','LoginController@login')->name('admin.login.page');
    Route::post('/check-login','LoginController@checkLogin')->name('check.admin.login');

    Route::get('/password/reset','AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::get('/password/reset/{token}','AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/email','AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset','AdminResetPasswordController@reset')->name('admin.password.update');
});
