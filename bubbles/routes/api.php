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
/** un authenticated user routes*/
Route::prefix('user')->namespace('User')->group(function () {
    Route::post('register','RegisterController@register');
    Route::post('verify','VerifyController@verify');
    Route::post('resend_verification_code','VerifyController@resend');
    Route::post('login','LoginController@login');

    Route::prefix('password')->group(function () {
        Route::post('forget','ResetPasswordController@sendCode');
        Route::post('check','ResetPasswordController@check');
        Route::post('reset','ResetPasswordController@resetPassword');
    });
});

/** unauthenticated driver routes*/
Route::prefix('driver')->namespace('Driver')->group(function () {
    Route::post('register','RegisterController@register');
    Route::post('verify','VerifyController@verify');
    Route::post('resend_verification_code','VerifyController@resend');
    Route::post('login','LoginController@login');

    Route::prefix('password')->group(function () {
        Route::post('forget','ResetPasswordController@sendCode');
        Route::post('check','ResetPasswordController@check');
        Route::post('reset','ResetPasswordController@resetPassword');
    });
});

Route::post('contact','ContactController@index');
Route::get('settings','SettingController@index');

/**authenticated user routes*/

Route::middleware('apiAuth')->group(function () {
    Route::prefix('user')->namespace('User')->group(function () {
        Route::get('profile', 'ProfileController@get');
        Route::post('profile', 'ProfileController@post');
        Route::post('update_registration_id', 'ProfileController@update_reg_id');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::get('favorite', 'UserFavoriteController@index');
        Route::get('packages', 'UserPackageController@index');
        Route::get('packages/status', 'UserPackageController@packages_status');
        Route::get('notifications','NotificationController@index');
    });


    Route::prefix('package')->middleware('apiAuth')->namespace('Package')->group(function () {
        Route::post('user_control','PackageController@userController')->middleware('checkPackageDone');
        Route::post('confirm_driver','PackageController@confirmDriver')->middleware('checkPackageDone');
        Route::post('store','StorePackageController@index');
        Route::post('update','UpdatePackageController@index');
        Route::get('requests/{id}','DeliverRequestController@packageRequests');
        Route::post('requests/delete','DeliverRequestController@deleteRequest');
        Route::get('{id}','PackageDetailsController@index');
        Route::post('notifcation','StorePackageController@notifcation2');
        
    });

    Route::post('package/delete_image','AttachController@delete');

    Route::post('rate','RateController@store');


    Route::prefix('follow')->group(function () {
        Route::post('store', 'FollowController@store')->middleware('userType');
        Route::post('delete', 'FollowController@delete')->middleware('userType');
    });



    Route::post('fcm/resubmit','FcmController@resubmit');
    
 

});

   Route::prefix('chat')->group(function () {
        Route::post('list','ChatController@index');
        Route::post('creat','ChatController@creat');
        Route::post('details','ChatController@details');
        Route::post('send-message','ChatController@send_message');
        Route::post('chat_closed','ChatController@chat_closed');
    });

/**authenticated driver routes*/

Route::middleware('driver')->group(function () {
    Route::prefix('driver')->namespace('Driver')->group(function () {
        Route::get('profile', 'ProfileController@get');
        Route::get('packages', 'DriverPackageController@index');
        Route::get('packages/status', 'DriverPackageController@packages_status');
        Route::post('profile', 'ProfileController@post');
        Route::post('update_registration_id', 'ProfileController@update_reg_id');
        Route::post('logout', 'LoginController@logout');
        Route::post('define_trip', 'DefineTripController@index');
        Route::post('change_password', 'ChangePassword@update');
    });

    Route::prefix('package')->namespace('Package')->group(function () {
        Route::get('details/{id}','PackageDetailsController@index');
        Route::post('driver_control','PackageController@driverController')->middleware('checkPackageDone');
        Route::post('deliver_request','DeliverRequestController@makeDeliverRequest');
    });
});
