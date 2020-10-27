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

Route::get('locale/{locale}', function ($locale){
    Session::put('front-locale', $locale);
    return redirect()->back();
});

  Route::get('/','HomeController@index');
  Route::get('/categories/{catname}','HomeController@cat_details');
  Route::get('/categories/{catname}/{proname}/{pro_id}','HomeController@pro_details');
  Route::get('search','HomeController@search');
  Route::post('subscribe','HomeController@subscribe');
  Route::get('about-us','HomeController@about');
  Route::get('terms-and-conditions','HomeController@terms');
  Route::get('contact-us','HomeController@contact');
  Route::post('contact-us','HomeController@contact_save');
  Route::get('faq','HomeController@faq');
  Route::get('my-account','HomeController@my_account');
  Route::post('login','HomeController@login');
  Route::get('register','HomeController@register');
  Route::post('register','HomeController@register_exe');
  Route::post('add-to-cart','HomeController@add_cart');
  Route::post('add-to-favorite','HomeController@add_fav');
  Route::post('remove-favorites','HomeController@remove_favorites');
  Route::post('remove-cart','HomeController@remove_cart');
  Route::post('add-review','HomeController@add_review');
  Route::post('filtering','HomeController@filtering');
  Route::get('favorites','HomeController@favorites');
  Route::get('cart','HomeController@cart');
  Route::get('session_veiw','HomeController@session_veiw');
  Route::post('salecode-check','HomeController@salecode_check');

  Route::prefix('vendor/dashboard')->middleware('vendor')->group(function () {
    Route::get('/','VendorController@index');
    Route::get('change-password','VendorController@change_password');
    Route::post('change-password','VendorController@change_password_exe');
    Route::get('logout','VendorController@logout');
    Route::get('my-profile','VendorController@my_profile');
    Route::post('update-profile','VendorController@update_profile');

    Route::prefix('product')->group(function () {
        Route::get('index', 'ProductController@index');
        Route::get('create', 'ProductController@create');
        Route::post('store', 'ProductController@store');
        Route::get('edit/{id}', 'ProductController@edit');
        Route::put('update/{id}/', 'ProductController@update');
        Route::get('delete/{id}/', 'ProductController@delete');
        Route::get('edit/{imageid}/', 'ProductController@edit');
        Route::put('update/{imageid}/', 'ProductController@update');
        Route::post('image_delete', 'ProductController@image_delete');
        Route::post('homeimg', 'ProductController@homeimg');
        Route::get('comments', 'VendorController@comments');
        Route::get('comment/suspend/{comment_id}', 'VendorController@comments_suspend');
        Route::get('orders/{status}', 'VendorController@orders');
        Route::get('order/items/{order_id}', 'VendorController@order_items');
        Route::post('order-item/status/change', 'VendorController@item_change_status');
    });

  });

  Route::middleware('user')->group(function () {
    Route::get('checkout','HomeController@checkout');
    Route::get('logout','HomeController@logout');
    Route::get('my-profile','HomeController@my_profile');
    Route::post('update-profile','HomeController@update_profile');
    Route::get('my-orders','HomeController@my_order');
    Route::get('done-order','HomeController@done_order');
    Route::get('my-orders','HomeController@my_orders');
    Route::get('order-details/{id}/','HomeController@order_details');
    Route::post('send-order','HomeController@send_order');
    Route::post('cancel-order','HomeController@cancel_order');
  });
