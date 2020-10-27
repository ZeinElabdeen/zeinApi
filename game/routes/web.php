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

Route::get('/','HomeController@index')->middleware('admin');

Route::prefix('dashboard')->name('dashboard.')->middleware('admin')->group(function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('index', 'Admin\AdminController@index');
        Route::get('create', 'Admin\AdminController@create');
        Route::post('store', 'Admin\AdminController@store');
        Route::get('delete/{id}', 'Admin\AdminController@delete');
        Route::get('change-password', 'Admin\ChangePasswordController@get')->name('changePassword.get');
        Route::post('change-password.post', 'Admin\ChangePasswordController@post')->name('changePassword.post');
    });

    Route::prefix('category')->group(function () {
        Route::get('index', 'CategoryController@index');
        Route::get('create', 'CategoryController@create');
        Route::post('store', 'CategoryController@store');
        Route::get('edit/{id}', 'CategoryController@edit');
        Route::post('update', 'CategoryController@update');
        Route::get('delete/{id}', 'CategoryController@delete');
    });

    Route::prefix('question')->group(function () {
        Route::get('index', 'QuestionController@index');
        Route::get('create', 'QuestionController@create');
        Route::post('store', 'QuestionController@store');
        Route::get('edit/{id}', 'QuestionController@edit');
        Route::post('update', 'QuestionController@update');
        Route::get('delete/{id}', 'QuestionController@delete');
        Route::get('import-execl', 'QuestionController@import_execl');
       Route::post('import-execl-save', 'QuestionController@import_execl_exe');
       Route::get('import-images', 'QuestionController@import_images');
       Route::post('import-images-exe', 'QuestionController@import_images_exe');
        //Route::post('import-execl-save', 'QuestionController@importFileIntoDB');
    });
});
