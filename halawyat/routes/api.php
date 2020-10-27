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

/** unauthenticated vendor routes*/
Route::prefix('vendor')->namespace('Vendor')->group(function () {
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

    /** category routes*/
Route::prefix('category')->group(function () {
    Route::get('/index','CategoryController@index');
    Route::get('/{id}','CategoryController@show');
});

    /**Home**/
Route::get('home','HomeController@index');

    /**offers routes*/
Route::get('offers','OfferController@index');

    /**Search route*/
Route::post('search','SearchController@index');

/**item in basket details route*/
Route::post('/basket','BasketController@index');


    /**settings**/
Route::get('setting/faq','FaqController@index');
Route::get('setting/{key}','SettingController@setting');
Route::get('contacts','ContactController@index');

/**authenticated user routes*/
Route::middleware('apiAuth')->group(function () {
    Route::prefix('user')->namespace('User')->group(function () {
        Route::get('profile', 'ProfileController@get');
        Route::post('profile', 'ProfileController@post');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::get('favorites', 'UserFavoriteController@index');
        Route::get('rates', 'UserRateController@index');
        Route::get('orders', 'UserOrderController@index');
        Route::get('notifications','NotificationController@index');
    });
    /** favorite routes*/
    Route::prefix('favorite')->group(function () {
        Route::post('store','FavoriteController@store');
        Route::post('delete','FavoriteController@delete');
        Route::get('delete_all','FavoriteController@deleteAll');
    });

    /** rate routes*/
    Route::prefix('rate')->group(function () {
        Route::post('store','RateController@store');
        Route::post('delete','FavoriteController@delete');
    });

    Route::prefix('vendor')->group(function () {
        Route::get('details/{id}','VendorController@show');
    });

    Route::get('item/details/{id}','ItemController@show');

    /**order routes*/
    Route::prefix('order')->group(function () {
        Route::get('show/{id}','OrderController@show');
        Route::post('store','OrderController@store');
        Route::post('delete','OrderController@delete');
        Route::post('confirm','OrderController@confirm');
        Route::post('reorder','ReorderController@index');
    });

    /**item price route*/
    Route::post('/item-price','ItemPriceController@index');

    /**notification route*/
    Route::get('/notifications','NotificationController@index');

    /**vendors on map route*/
    Route::post('/map','MapController@index');

});

/**authenticated vendor routes*/

Route::middleware('vendor')->group(function () {
    Route::prefix('vendor')->namespace('Vendor')->group(function () {
        Route::get('subcategories','CategoryController@vendorSubcategories');
        Route::get('home', 'HomeController@index');
        Route::get('profile', 'ProfileController@get');
        Route::post('profile', 'ProfileController@post');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::get('orders', 'OrderController@index');
        Route::prefix('order')->group(function () {
            Route::get('details/{id}','OrderController@details');
            Route::get('accept/{id}','OrderController@accept');
            Route::get('reject/{id}','OrderController@reject');
        });
    });



    Route::prefix('item')->group(function () {
        Route::post('store','ItemController@store');
        Route::get('show/{id}','ItemController@edit');
        Route::post('delete','ItemController@delete');
        Route::post('update','ItemController@update');
    });

});
