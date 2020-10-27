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
    Route::post('verify','User\EmailVerifyController@verify');
    Route::post('resend_verification_email','User\EmailVerifyController@resend');
    Route::post('login','User\LoginController@login');

        Route::prefix('password')->group(function () {
            Route::post('forget','User\ResetPasswordController@sendCode');
            Route::post('check','User\ResetPasswordController@check');
            Route::post('reset','User\ResetPasswordController@resetPassword');
    });

});

    /** category routes*/
Route::prefix('category')->group(function () {
    Route::get('/index','CategoryController@index');
    Route::get('/{id}','CategoryController@show');
});

    /**Home**/
Route::get('home','HomeController@index');

/** coupon value route*/
Route::post('coupon/value','CouponController@index');


    /**offers routes*/
Route::get('offers','OfferController@index');

    /**Search route*/
Route::post('search','SearchController@index');

/**item in basket details route*/
Route::post('/basket','BasketController@index');


    /**settings**/
Route::get('setting/faq','FaqController@index');
Route::get('setting/{key}','SettingController@setting');
Route::post('contact-us','ContactController@index');

Route::middleware('apiAuth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('profile','User\ProfileController@get');
        Route::post('profile','User\ProfileController@post');
        Route::post('update_image','User\ProfileController@updateImage');
        Route::post('logout','User\LoginController@logout');
        Route::get('favorite','User\UserFavoriteController@index');
        Route::get('orders/{type}','User\UserOrderController@index');
    });

    /** favorites routes*/
    Route::prefix('favorite')->group(function () {
        Route::post('store','FavoriteController@store');
        Route::post('delete','FavoriteController@delete');
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
