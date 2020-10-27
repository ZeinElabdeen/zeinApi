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
        //Route::get('index', 'Admin\AdminController@index');
      //  Route::get('create', 'Admin\AdminController@create');
      //  Route::post('store', 'Admin\AdminController@store');
      //  Route::get('delete/{id}', 'Admin\AdminController@delete');
        Route::get('change-password', 'Admin\ChangePasswordController@get')->name('changePassword.get');
        Route::post('change-password.post', 'Admin\ChangePasswordController@post')->name('changePassword.post');
    });
    Route::prefix('plan')->group(function () {
        Route::get('index', 'PlanController@index');
        Route::get('create', 'PlanController@create');
        Route::post('store', 'PlanController@store');
        Route::get('edit/{id}', 'PlanController@edit');
        Route::post('update', 'PlanController@update');
        Route::get('delete/{id}', 'PlanController@delete');
    });
    Route::prefix('category')->group(function () {
        Route::get('index', 'CategoryController@index');
        Route::get('create', 'CategoryController@create');
        Route::post('store', 'CategoryController@store');
        Route::get('edit/{id}', 'CategoryController@edit');
        Route::post('update', 'CategoryController@update');
        Route::get('delete/{id}', 'CategoryController@delete');
    });
    Route::prefix('city')->group(function () {
        Route::get('index', 'CityController@index');
        Route::get('create', 'CityController@create');
        Route::post('store', 'CityController@store');
        Route::get('edit/{id}', 'CityController@edit');
        Route::post('update', 'CityController@update');
        Route::get('delete/{id}', 'CityController@delete');
    });
    Route::prefix('ad')->group(function () {
        Route::get('index', 'AdController@index');
        Route::get('create', 'AdController@create');
        Route::post('store', 'AdController@store');
        Route::get('edit/{id}', 'AdController@edit');
        Route::post('update', 'AdController@update');
        Route::get('delete/{id}', 'AdController@delete');
    });

    Route::prefix('setting')->group(function () {
        Route::get('index','SettingController@setting');
        Route::get('edit/{key}','SettingController@edit');
        Route::post('update','SettingController@update');
        Route::post('updateContact','SettingController@updateContact');
    });


    Route::prefix('faq')->group(function () {
        Route::get('index','FaqController@index');
        Route::get('create','FaqController@create');
        Route::post('store','FaqController@store');
        Route::get('edit/{id}','FaqController@edit');
        Route::post('update','FaqController@update');
        Route::get('delete/{id}','FaqController@delete');
    });

    Route::prefix('salecodes')->group(function () {
          Route::get('index','SalecodesController@index');
          Route::get('create','SalecodesController@create');
          Route::post('store','SalecodesController@store');
          Route::get('edit/{id}','SalecodesController@edit');
          Route::post('update','SalecodesController@update');
          Route::get('delete/{id}','SalecodesController@delete');
          Route::get('suspend/{id}','SalecodesController@suspend');

      });

  Route::prefix('users')->group(function () {
    Route::get('clients','UsersController@index');
    Route::get('vendors','UsersController@index');
    Route::get('delete/{id}','UsersController@delete');
    Route::get('suspend/{id}','UsersController@suspend');
    Route::get('show_ad/{id}','UsersController@show_ad');
  });

    Route::get('contact-messages','ContactUsController@index');
    Route::get('contact-messages/delete/{id}','ContactUsController@delete');
});
