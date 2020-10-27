<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*login for user and vendor */
Route::post('login','User\LoginController@login');
Route::get('preRegister','PreRegisterController@index');


Route::prefix('user')->group(function () {
    Route::post('user_register','User\User\RegisterController@register');
    Route::post('vendor_register','User\Vendor\RegisterController@register');
    Route::post('verify','User\VerifyController@verify');
    Route::post('resend_verification','User\VerifyController@resend');
    Route::post('login','User\LoginController@login');

    Route::prefix('password')->group(function () {
        Route::post('forget','User\ResetPasswordController@sendCode');
        Route::post('check','User\ResetPasswordController@check');
        Route::post('reset','User\ResetPasswordController@resetPassword');
    });

});
Route::middleware('apiAuth')->group(function () {
    Route::prefix('user')->group(function () {
    Route::get('details','User\UserDetailsController@index');
    Route::post('user_profile','User\User\ProfileController@updateProfile');
    Route::post('vendor_profile','User\Vendor\ProfileController@updateProfile')->middleware('vendor');
    Route::post('update_vendor_details','User\Vendor\ProfileController@updateDetails')->middleware('vendor');
    Route::post('delete_attach','User\Vendor\ProfileController@delete_attach')->middleware('vendor');
    Route::post('update_password','User\UpdatePassword@index');
    Route::post('update_image','User\UpdateImage@index');
    Route::post('logout','User\LoginController@logout');
    Route::post('submit_fcm_token','FCMController@submitToken');
    Route::get('sendN','FCMController@sendN');
    Route::get('favorite','User\User\UserFavoriteController@index');
    Route::get('rooms','User\UserMessageController@userRooms');
    Route::get('roomMessages/{id}','User\UserMessageController@RoomMessages');
    Route::post('check_exists_room','User\UserMessageController@checkExistsRoom');
    });

    Route::prefix('message')->group(function (){
        Route::post('send','MessageController@send');
    });

    Route::post('rate','RateController@index');
    Route::prefix('favorite')->group(function (){
        Route::post('store','FavoriteController@store');
        Route::post('delete','FavoriteController@delete');
    });
    Route::prefix('plan')->group(function (){
        Route::get('all','PlanController@index');
        Route::post('subscribe','PlanController@subscribe');
    });
});
Route::get('home','HomeController@index');
Route::post('category/{id}','CategoryController@index');
Route::post('contact_us','ContactController@index');
Route::get('vendor/{id}','VendorDetailsController@index');
Route::get('search','SearchController@index');

Route::get('setting/faq','FaqController@index');
Route::get('setting/contacts','SettingController@contacts');
Route::get('setting/{key}','SettingController@setting');
Route::get('promo_code/{code}','SalecodesController@promo_code');
