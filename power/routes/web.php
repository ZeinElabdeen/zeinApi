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

//Route::get('/', function () {
//    return view('dashboard.index');
//});

/** Admin Auth Routes*/

Route::prefix('admin')->middleware('guestAdmin')->group(function () {
    Route::get('login','Admin\LoginController@get');
    Route::post('login_post','Admin\LoginController@post');
    Route::get('forget-password','Admin\ForgetPasswordController@forgetPassword')->name('forgetPassword.get');
    Route::post('forget-password/post','Admin\ForgetPasswordController@forgetPasswordPost')->name('forgetPassword.post');
    Route::get('reset-password/{email}/{token}','Admin\ForgetPasswordController@resetPassword')->name('resetPassword.get');
    Route::post('reset-password/post','Admin\ForgetPasswordController@resetPasswordPost')->name('resetPassword.post');

});


Route::prefix('dashboard')->name('dashboard.')->middleware('admin')->group(function () {
    // home page
    Route::get('/','HomeController@index')->name('home');
    // admin routes
    Route::get('/logout','Admin\LoginController@logout')->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('index','Admin\AdminController@index');
        Route::get('create','Admin\AdminController@create');
        Route::post('store','Admin\AdminController@store');
        Route::get('delete/{id}','Admin\AdminController@delete');
        Route::get('change-password','Admin\ChangePasswordController@get')->name('changePassword.get');
        Route::post('change-password.post','Admin\ChangePasswordController@post')->name('changePassword.post');
    });

    Route::prefix('user')->group(function () {
        Route::get('suspend/{id}','UserController@suspend');
        Route::get('activate/{id}','UserController@activate');
        Route::get('delete/{id}','UserController@delete');
        Route::get('/all','UserController@index');
    });

    Route::prefix('vendors')->group(function () {
        Route::get('suspend/{id}','VendorsController@suspend');
        Route::get('activate/{id}','VendorsController@activate');
        Route::get('show/{id}','VendorsController@show');
        Route::get('delete/{id}','VendorsController@delete');
        Route::get('/all','VendorsController@index');
    });


    Route::prefix('ad')->group(function () {
        Route::get('index','AdController@index');
        Route::get('create','AdController@create');
        Route::post('store','AdController@store');
        Route::get('edit/{id}','AdController@edit');
        Route::post('update','AdController@update');
        Route::get('delete/{id}','AdController@delete');
        Route::get('suspend/{id}','AdController@suspend');
        Route::get('activate/{id}','AdController@activate');
    });

    Route::prefix('setting')->group(function () {
        Route::get('edit/{key}','SettingController@edit');
        Route::post('update','SettingController@update');
        Route::post('updateContact','SettingController@updateContact');
    });

    Route::prefix('salecodes')->group(function () {
          Route::get('index','SalecodesController@index');
          Route::get('create','SalecodesController@create');
          Route::post('store','SalecodesController@store');
          Route::get('edit/{id}','SalecodesController@edit');
          Route::post('update','SalecodesController@update');
          Route::get('delete/{id}','SalecodesController@delete');
          Route::get('suspend/{id}','SalecodesController@suspend');
          Route::get('randomId','SalecodesController@randomId');
      });

    Route::prefix('car_models')->group(function () {
          Route::get('all','CarModelsController@index');
          Route::get('create','CarModelsController@create');
          Route::post('store','CarModelsController@store');
          Route::get('edit/{id}','CarModelsController@edit');
          Route::post('update','CarModelsController@update');
          Route::get('delete/{id}','CarModelsController@delete');

      });

    Route::prefix('car_types')->group(function () {
          Route::get('all','CartypeController@index');
          Route::get('create','CartypeController@create');
          Route::post('store','CartypeController@store');
          Route::get('edit/{id}','CartypeController@edit');
          Route::post('update','CartypeController@update');
          Route::get('delete/{id}','CartypeController@delete');

      });

    Route::prefix('reasons')->group(function () {
          Route::get('/{type}','ReasonsController@index');
          Route::get('create/{type}','ReasonsController@create');
          Route::post('store','ReasonsController@store');
          Route::get('edit/{id}','ReasonsController@edit');
          Route::post('update','ReasonsController@update');
          Route::get('delete/{id}','ReasonsController@delete');

      });

      Route::prefix('coupon')->group(function () {
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

    Route::get('contact-messages','ContactUsController@index');
    Route::get('contact-messages/delete/{id}','ContactUsController@delete');

});
