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

//Auth::routes(['register' => false]);
//Route::get('/home', 'HomeController@index')->name('home');


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login','Admin\LoginController@get');
    Route::post('login/post','Admin\LoginController@post');
    Route::get('forget-password','Admin\ForgetPasswordController@forgetPassword')->name('forgetPassword.get');
    Route::post('forget-password/post','Admin\ForgetPasswordController@forgetPasswordPost')->name('forgetPassword.post');
    Route::get('reset-password/{email}/{token}','Admin\ForgetPasswordController@resetPassword')->name('resetPassword.get');
    Route::post('reset-password/post','Admin\ForgetPasswordController@resetPasswordPost')->name('resetPassword.post');
});

Route::prefix('dashboard')->name('dashboard.')->middleware('admin')->group(function () {
    Route::get('','HomeController@index')->name('home');
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
        Route::get('delete/{id}','VendorsController@delete');
        Route::get('/all','VendorsController@index');
    });

    Route::prefix('setting')->group(function () {
        Route::get('index','SettingController@setting');
        Route::get('edit/{key}','SettingController@edit');
        Route::post('update','SettingController@update');
        Route::post('updateContact','SettingController@updateContact');
    });



    Route::get('contact-messages','ContactUsController@index');
    Route::get('contact-messages/delete/{id}','ContactUsController@delete');

});
