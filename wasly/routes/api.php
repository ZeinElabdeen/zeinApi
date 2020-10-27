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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('user')->group(function () {
    Route::post('register','User\RegisterController@register');
    //Route::post('verify','User\VerifyController@verify');
    //Route::post('resend_verification_code','User\VerifyController@resend');
    Route::post('login','User\LoginController@login');

        Route::prefix('password')->group(function () {
            Route::post('forget','User\ResetPasswordController@sendCode');
            Route::post('check','User\ResetPasswordController@check');
            Route::post('reset','User\ResetPasswordController@resetPassword');
    });

});
/** cities and states routes*/

Route::get('states_cities','StateController@index');


    /** category routes*/
Route::prefix('category')->group(function () {
//    Route::get('/index','CategoryController@index');
    Route::get('/{id}','CategoryController@show');
});

    /** brand routes*/
Route::prefix('brand')->group(function () {
    Route::get('/{id}','BrandController@show');
});

    /** classification routes*/
Route::prefix('classification')->group(function () {
    Route::get('/{id}','ClassificationController@show');
});

/** item routes*/
Route::prefix('item')->group(function () {
    Route::get('rates/{id}','ItemController@itemRates');
    Route::get('/{id}','ItemController@show');
});

    /**Home**/
Route::get('home','HomeController@index');

/** coupon value route*/
Route::post('coupon/value','CouponController@index');

/**item in basket details route*/
Route::post('/basket','BasketController@index');
Route::get('/shipping_price/{id}','BasketController@shippingPrice');


    /**Search route*/
Route::post('search','SearchController@index');



    /**settings**/
Route::get('setting/faq','FaqController@index');
Route::get('setting/contacts','SettingController@contacts');
Route::get('setting/{key}','SettingController@setting');
Route::post('contact-us','ContactController@index');

Route::middleware('apiAuth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('profile','User\ProfileController@get');
        Route::post('profile','User\ProfileController@post');
        Route::post('update_image','User\ProfileController@updateImage');
        Route::post('change_password','User\ChangePassword@index');
        Route::post('logout','User\LoginController@logout');
        Route::get('favorite','User\UserFavoriteController@index');
        Route::get('orders','User\UserOrderController@index');
        Route::get('notifications','NotificationController@index');
        Route::post('submit_fcm_token','FCMController@submitToken');

    });

    /** favorites routes*/
    Route::prefix('rate')->group(function () {
        Route::post('store','RateController@store');
        Route::post('item_rates/{id}','RateController@itemRates');
    });

    /**order routes*/
    Route::prefix('order')->group(function () {
        Route::get('show/{id}','OrderController@show');
        Route::post('store','OrderController@store');
        Route::post('delete','OrderController@delete');
        Route::post('confirm','OrderController@confirm');
        Route::post('reorder','ReorderController@index');
    });

    /**wallet, points and tax route*/
    Route::get('/money','MoneyController@index');
    Route::get('/convert-points','MoneyController@convertPoints');

    /**item price route*/
    Route::post('/item-price','ItemPriceController@index');

    /**notification route*/
    Route::get('/notifications','NotificationController@index');

});
