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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login','Admin\LoginController@get');
    Route::post('login/post','Admin\LoginController@post');
    Route::get('forget-password','Admin\ForgetPasswordController@forgetPassword')->name('forgetPassword.get');
    Route::post('forget-password/post','Admin\ForgetPasswordController@forgetPasswordPost')->name('forgetPassword.post');
    Route::get('reset-password/{email}/{token}','Admin\ForgetPasswordController@resetPassword')->name('resetPassword.get');
    Route::post('reset-password/post','Admin\ForgetPasswordController@resetPasswordPost')->name('resetPassword.post');
});

Route::prefix('dashboard')->name('dashboard.')->middleware('admin')->group(function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('index', 'Admin\AdminController@index')->middleware('adminRole');
        Route::get('create', 'Admin\AdminController@create')->middleware('adminRole');
        Route::post('store', 'Admin\AdminController@store')->middleware('adminRole');
        Route::get('delete/{id}', 'Admin\AdminController@delete')->middleware('adminRole');
        Route::get('change-password', 'Admin\ChangePasswordController@get')->name('changePassword.get');
        Route::post('change-password.post', 'Admin\ChangePasswordController@post')->name('changePassword.post');
    });
    Route::prefix('plan')->middleware('adminRole')->group(function () {
        Route::get('index', 'PlanController@index');
        Route::get('create', 'PlanController@create');
        Route::post('store', 'PlanController@store');
        Route::get('edit/{id}', 'PlanController@edit');
        Route::post('update', 'PlanController@update');
        Route::get('delete/{id}', 'PlanController@delete');
    });
    Route::prefix('category')->middleware('adminRole')->group(function () {
        Route::get('index', 'CategoryController@index');
        Route::get('create', 'CategoryController@create');
        Route::post('store', 'CategoryController@store');
        Route::get('edit/{id}', 'CategoryController@edit');
        Route::post('update', 'CategoryController@update');
        Route::get('delete/{id}', 'CategoryController@delete');
    });

    Route::prefix('brand')->middleware('adminRole')->group(function () {
        Route::get('index', 'BrandController@index');
        Route::get('create', 'BrandController@create');
        Route::post('store', 'BrandController@store');
        Route::get('edit/{id}', 'BrandController@edit');
        Route::post('update', 'BrandController@update');
        Route::get('delete/{id}', 'BrandController@delete');
        Route::get('classifications/{id}', 'BrandController@brandClassifications');
        Route::get('reports/{id}', 'BrandController@reports');
    });

    Route::prefix('classification')->middleware('adminRole')->group(function () {
        Route::get('index', 'ClassificationController@index');
        Route::get('create', 'ClassificationController@create');
        Route::post('store', 'ClassificationController@store');
        Route::get('edit/{id}', 'ClassificationController@edit');
        Route::post('update', 'ClassificationController@update');
        Route::get('delete/{id}', 'ClassificationController@delete');
    });

    Route::prefix('item')->middleware('adminRole')->group(function () {
        Route::get('index', 'ItemController@index');
        Route::get('create', 'ItemController@create');
        Route::post('store', 'ItemController@store');
        Route::get('edit/{id}', 'ItemController@edit');
        Route::post('update', 'ItemController@update');
        Route::get('delete/{id}', 'ItemController@delete');
        Route::get('attach/delete/{id}', 'AttachController@delete')->name('deleteAttach');
        Route::get('detail/delete/{id}', 'ItemDetailsController@delete')->name('deleteDetail');
    });

    Route::prefix('state')->middleware('adminRole')->group(function () {
        Route::get('index', 'StateController@index');
        Route::get('create', 'StateController@create');
        Route::post('store', 'StateController@store');
        Route::get('edit/{id}', 'StateController@edit');
        Route::post('update', 'StateController@update');
        Route::get('delete/{id}', 'StateController@delete');
    });

    Route::prefix('city')->middleware('adminRole')->group(function () {
        Route::get('index', 'CityController@index');
        Route::get('create', 'CityController@create');
        Route::post('store', 'CityController@store');
        Route::get('edit/{id}', 'CityController@edit');
        Route::post('update', 'CityController@update');
        Route::get('delete/{id}', 'CityController@delete');
        Route::get('state_cities/{id}', 'CityController@stateCities');
    });

    Route::prefix('village')->middleware('adminRole')->group(function () {
        Route::get('index', 'VillageController@index');
        Route::get('create', 'VillageController@create');
        Route::post('store', 'VillageController@store');
        Route::get('edit/{id}', 'VillageController@edit');
        Route::post('update', 'VillageController@update');
        Route::get('delete/{id}', 'VillageController@delete');
    });

    Route::prefix('ad')->middleware('adminRole')->group(function () {
        Route::get('index', 'AdController@index');
        Route::get('create', 'AdController@create');
        Route::post('store', 'AdController@store');
        Route::get('edit/{id}', 'AdController@edit');
        Route::post('update', 'AdController@update');
        Route::get('delete/{id}', 'AdController@delete');
    });


    Route::prefix('faq')->middleware('adminRole')->group(function () {
        Route::get('index','FaqController@index');
        Route::get('create','FaqController@create');
        Route::post('store','FaqController@store');
        Route::get('edit/{id}','FaqController@edit');
        Route::post('update','FaqController@update');
        Route::delete('delete','FaqController@delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('create','OrderController@create');
        Route::post('store','OrderController@store');
        Route::post('update','OrderController@update');
        Route::delete('delete','OrderController@delete');
        Route::get('show/{id}','OrderController@show');
        Route::get('/{type}','OrderController@index');
        Route::get('status/{id}/{status}','OrderController@status')->name('orderStatus');
    });


    Route::prefix('user')->middleware('adminRole')->group(function () {
        Route::get('index','UserController@index');
        Route::get('suspend/{id}','UserController@suspend');
        Route::get('activate/{id}','UserController@activate');
      //  Route::delete('delete','UserController@delete');
        Route::get('show/{id}','UserController@show');
        Route::get('orders/{id}','OrderController@userOrders');
        Route::get('delete/{id}', 'UserController@delete');
        Route::get('edit/{id}', 'UserController@edit');
        Route::post('update', 'UserController@update');
    });

    Route::prefix('coupon')->middleware('adminRole')->group(function () {
        Route::get('index', 'CouponController@index');
        Route::get('create', 'CouponController@create');
        Route::post('store', 'CouponController@store');
        Route::get('edit/{id}', 'CouponController@edit');
        Route::post('update', 'CouponController@update');
        Route::get('delete/{id}', 'CouponController@delete');
        Route::get('randomId', 'CouponController@randomId');
        Route::get('suspend/{id}','CouponController@suspend');
        Route::get('activate/{id}','CouponController@activate');
    });

    Route::prefix('notification')->middleware('adminRole')->group(function () {
        Route::get('create','NotificationController@create');
        Route::post('store','NotificationController@store');
    });

    Route::prefix('setting')->middleware('adminRole')->group(function () {
        Route::get('{type}','SettingController@edit');
        Route::post('update','SettingController@update');
        Route::post('updateContact','SettingController@updateContact');
    });

    Route::get('contact-messages','ContactUsController@index')->middleware('adminRole');
    Route::get('contact-messages/delete/{id}','ContactUsController@delete')->middleware('adminRole');
});
