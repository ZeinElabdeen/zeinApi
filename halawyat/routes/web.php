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

    Route::prefix('category')->group(function () {
        Route::get('index','CategoryController@index');
        Route::get('create','CategoryController@create');
        Route::post('store','CategoryController@store');
        Route::get('edit/{id}','CategoryController@edit');
        Route::post('update','CategoryController@update');
        Route::get('delete/{id}','CategoryController@delete');
    });

    Route::prefix('category/minors')->group(function () {
        Route::get('all','CategoryMinorsController@index');
        Route::get('create','CategoryMinorsController@create');
        Route::post('store','CategoryMinorsController@store');
        Route::get('edit/{id}','CategoryMinorsController@edit');
        Route::post('update','CategoryMinorsController@update');
        Route::get('delete/{id}','CategoryMinorsController@delete');
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
        Route::get('delete/{id}','VendorsController@delete');
        Route::get('/all','VendorsController@index');
    });


    // Route::prefix('ad')->group(function () {
    //     Route::get('index','AdController@index');
    //     Route::get('create','AdController@create');
    //     Route::post('store','AdController@store');
    //     Route::get('edit/{id}','AdController@edit');
    //     Route::post('update','AdController@update');
    //     Route::delete('delete','AdController@delete');
    //     Route::get('suspend/{id}','AdController@suspend');
    //     Route::get('activate/{id}','AdController@activate');
    // });

    Route::prefix('setting')->group(function () {
        Route::get('edit/{key}','SettingController@edit');
        Route::post('update','SettingController@update');
        Route::post('updateContact','SettingController@updateContact');
    });

    // Route::prefix('faq')->group(function () {
    //     Route::get('index','FaqController@index');
    //     Route::get('create','FaqController@create');
    //     Route::post('store','FaqController@store');
    //     Route::get('edit/{id}','FaqController@edit');
    //     Route::post('update','FaqController@update');
    //     Route::delete('delete','FaqController@delete');
    // });

    Route::prefix('order')->group(function () {
        Route::get('{type}','OrderController@index');
        Route::get('show/{id}','OrderController@show');
        Route::get('status/{id}/{status}','OrderController@status')->name('orderStatus');
    });

});
