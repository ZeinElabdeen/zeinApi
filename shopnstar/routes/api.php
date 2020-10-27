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
    Route::get('/vendor/{vendor_id}','CategoryController@index');
    Route::get('/{id}','CategoryController@show');
    Route::get('/vendor/items/{cat_id}','ItemController@all_items');
});

    /**Home**/
Route::get('home','HomeController@index');
Route::get('ads','HomeController@ads');
Route::get('reasons','HomeController@reasons');

Route::post('login','HomeController@login');

Route::prefix('password')->group(function () {
    Route::post('forget','HomeController@sendCode');
    Route::post('check','HomeController@check');
    Route::post('reset','HomeController@resetPassword');
});

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
        Route::get('orders/{type}', 'UserOrderController@index');
        Route::get('notifications','NotificationController@index');
    });
    /** favorite routes*/
    Route::prefix('favorite')->group(function () {
        Route::post('store','FavoriteController@store');
        Route::post('delete','FavoriteController@delete');
        //Route::get('delete_all','FavoriteController@deleteAll');
    });

    /** basket routes*/
    Route::prefix('basket')->group(function () {
      Route::get('all', 'BasketController@all');
      Route::post('store','BasketController@store');
      Route::post('delete','BasketController@delete');
    });

    /** rate routes*/
    Route::prefix('rate')->group(function () {
        Route::post('store','RateController@store');
        Route::post('delete','FavoriteController@delete');
    });

    Route::prefix('vendor')->group(function () {
        Route::get('details/{id}','VendorController@show');
    });


    Route::post('item/rate/store','RateController@store_rate_item');
    Route::get('item/details/{id}','ItemController@show');

    /**order routes*/
    Route::prefix('order')->group(function () {
        Route::get('show/{id}','OrderController@show');
        Route::post('store','OrderController@store');
      //  Route::post('delete','OrderController@delete');

      //  Route::post('reorder','ReorderController@index');
    });

    /**item price route*/
    //Route::post('/item-price','ItemPriceController@index');

    /**notification route*/
    Route::get('/notifications','NotificationController@index');

    /**vendors on map route*/
    //Route::post('/map','MapController@index');

});


Route::group(['middlewareGroups' => ['role:vendor', 'apiAuth']], function() {

    Route::prefix('chat')->group(function () {
        Route::post('list','ChatController@index');
        Route::post('creat','ChatController@creat');
        Route::post('details','ChatController@details');
        Route::post('send-message','ChatController@send_message');
        Route::post('chat_closed','ChatController@chat_closed');
    });

 });

/**authenticated vendor routes*/

Route::middleware('vendor')->group(function () {
    Route::prefix('vendor')->namespace('Vendor')->group(function () {
        Route::get('categories_list','CategoryController@categories_list');
        Route::get('categories','CategoryController@vendorCategories');
        Route::post('update_cats_list','CategoryController@update_cats_list');
      //  Route::post('categories/add','CategoryController@vendorCategoriesAdd');
      //  Route::get('home', 'HomeController@index');
        Route::get('rates', 'ProfileController@myrates');
        Route::get('profile', 'ProfileController@get');
        Route::post('profile', 'ProfileController@post');
        Route::post('logout', 'LoginController@logout');
        Route::post('change_password', 'ChangePassword@update');
        Route::get('orders', 'OrderController@index');
        Route::get('orders/{type}', 'OrderController@index');
        Route::get('bills/{type}', 'OrderController@bills');
        Route::prefix('order')->group(function () {
            Route::get('details/{id}','OrderController@details');
            Route::get('accept/{id}','OrderController@accept');
            Route::get('shipping/{id}','OrderController@shipping');
            Route::get('delivered/{id}','OrderController@delivered');
            Route::post('reject','OrderController@reject');
        });
    });



    Route::get('vendor/myItems/{cat_id}','ItemController@index');
    Route::get('vendor/myItems','ItemController@index');
    Route::get('vendor/myOffers/{cat_id}','ItemController@myOffers');
    Route::get('vendor/myOffers','ItemController@myOffers');
    Route::prefix('item')->group(function () {
        Route::post('store','ItemController@store');
        Route::get('show/{id}','ItemController@edit');
        Route::post('delete','ItemController@delete');
        Route::post('update','ItemController@update');
    });


});
