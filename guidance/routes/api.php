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

Route::get('/swoole/start', function () {
    Artisan::call('swoole:start');
    //
});
Route::get('ads','AdController@index');
Route::get('cars_models_and_types','CarController@carsModelsAndTypes');


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
Route::get('settings/contacts','SettingController@contacts');
Route::get('settings/about_us','SettingController@about');
Route::get('settings/terms','SettingController@terms');

/**authenticated user routes*/

Route::middleware('user')->group(function () {
    Route::prefix('user')->namespace('User')->group(function () {
        Route::get('profile', 'ProfileController@get');
        Route::post('profile', 'ProfileController@post');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::get('people_orders/{status}', 'UserOrderController@peopleTransfers');
        Route::get('packages_orders/{status}', 'UserOrderController@packagesTransfers');
        Route::get('notifications','NotificationController@index');

        Route::post('rate','RateController@store');
        Route::get('rates','RateController@userRates');
        Route::get('notification_status/{status}','NotificationController@status');
        Route::post('submit_fcm_token','FcmController@submitToken');
    });
    Route::get('user/cancel_reasons','CancelReasonController@userReasons');


    Route::prefix('order')->middleware('user')->namespace('Order')->group(function () {
        Route::post('user_control','OrderController@userControl')->middleware('checkOrderDone');
        Route::post('confirm_driver','OrderController@confirmDriver')->middleware('checkOrderDone');
        Route::post('delete','OrderController@delete')->middleware('checkOrderDone');
        Route::post('store','StoreOrderController@index');
        Route::post('update','UpdateOrderController@index');
        Route::get('messages/{id}','OrderMessagesController@orderRoomMessages');
        Route::get('requests/{id}','DeliverRequestController@orderRequests');
        Route::post('request-details','DeliverRequestController@orderRequest_details');
        Route::post('requests/delete','DeliverRequestController@deleteRequest');
//        Route::get('{id}','OrderDetailsController@index');
    });

    Route::post('package/delete_image','AttachController@delete');


    Route::prefix('place')->middleware('user')->group(function () {
        Route::get('user_places', 'PlaceController@userPlaces');
        Route::post('store', 'PlaceController@store');
        Route::post('delete', 'PlaceController@delete');
    });



    Route::post('fcm/resubmit','FcmController@resubmit');

});

/**authenticated driver routes*/

Route::middleware('driver')->group(function () {
    Route::prefix('driver')->namespace('Driver')->group(function () {
        Route::get('profile', 'ProfileController@get');
        Route::get('orders/{status}', 'DriverOrderController@index');
        Route::post('profile', 'ProfileController@post');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::post('charge-wallet', 'ProfileController@charge_wallet');

        Route::prefix('order')->group(function () {
            Route::post('driver_control','OrderController@driverController')->middleware('checkOrderDone');
            Route::post('make_deliver_request','DeliverOrderRequestController@makeRequest');
            Route::post('delete_deliver_request','DeliverOrderRequestController@deleteRequest');
        });

        Route::post('rate','RateController@store');
        Route::get('rates','RateController@driverRates');
        Route::get('notifications','NotificationController@index');
        Route::get('notification_status/{status}','NotificationController@status');
        Route::post('submit_fcm_token','FcmController@submitToken');

    });

    Route::prefix('order')->namespace('Order')->group(function () {
        Route::post('driver_control','OrderController@driverController')->middleware('checkOrderDone');
    });


    Route::get('driver/cancel_reasons','CancelReasonController@driverReasons');

    Route::prefix('order')->group(function () {
        Route::get('all','Order\OrderController@ordersList');
        Route::get('details/{id}','Order\OrderDetailsController@index');
        Route::get('driver/messages/{id}','Order\OrderMessagesController@driver_orderRoomMessages');
    });

});

Route::prefix('message')->group(function (){
    Route::post('send','MessageController@sendMessage');
});
