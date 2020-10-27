<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

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






Route::get('getAll',function(){    
    return Session()->all();
});

Route::get('link',function(){
    Artisan::call('storage:link');
    return "DONE";
});

Route::get('clear',function(){
    Artisan::call('cache:clear');
    return "DONE";
});

Route::get('clear1',function(){
    Artisan::call('config:cache');
    return "DONE";
});

Route::get('migrate',function(){
    Artisan::call('migrate');
    return "DONE";
});


Route::post('change-lang','Controller@changeLang');//->middleware('changeLang');


Route::group(['namespace' => 'user'], function () {
    
    Route::get('/','indexController@index');
    Route::get('all-courses','courseUserController@index');
    Route::get('courses-details/{id}','courseUserController@courseDetails');
    Route::get('courses-search','courseUserController@coursesSearch');

    Route::get('all-institutes','instituteUserController@index');
    Route::get('institute-details/{id}','instituteUserController@instituteDetails');
    Route::get('institute-search','instituteUserController@instituteSearch');

    Route::get('photoGallery','staticPageController@getPhoto');
    Route::get('wishlist','staticPageController@getWish')->middleware('authProtection');
    Route::get('addWishList/{id}','staticPageController@addWishList')->middleware('authProtection');
    Route::get('vedioGallery','staticPageController@getvedio');
    Route::get('terms_and_condition','staticPageController@getTermsAndCondition');
    Route::get('conact_us','staticPageController@getContactUs');
    Route::post('sendMessage','staticPageController@contactUs')->middleware('authProtection');
    Route::get('about-us','staticPageController@aboutUs');
    Route::get('banksAcc','staticPageController@bankAccount')->middleware('authProtection');
    Route::get('all-notes','staticPageController@allNotes')->middleware('authProtection');
    Route::post('editNote/{student_id}/{note_id}','staticPageController@editNote')->middleware('authProtection','checkCertainUser:student_id');
    Route::post('deleteNote/{student_id}/{note_id}','staticPageController@deleteNote')->middleware('authProtection','checkCertainUser:student_id');
    Route::get('add-note','staticPageController@getAddNote')->middleware('authProtection');
    Route::post('add-note','staticPageController@addNote')->middleware('authProtection');




    Route::post('add-reservation/{course_id}','reservationUserController@addReservation')->middleware('authProtection');
    Route::get('my-reservations','reservationUserController@myReservations')->middleware('authProtection');
    Route::get('reservation-details/{student_id}/{reservation_id}','reservationUserController@reservationsDetails')->middleware('authProtection','checkCertainUser:student_id');
    Route::post('sendInvoice/{student_id}/{reservation_id}','reservationUserController@pdfDown')->middleware('authProtection');
    Route::get('passport-reservation','reservationUserController@passportDetails')->middleware('authProtection');
    Route::get('pdf-download/{student_id}/{reservation_id}','reservationUserController@pdfDown');



    Route::get('account','authUserController@index');
    Route::post('account','authUserController@login');
    Route::post('update-profile/{id}','authUserController@updateProfile');
    Route::post('logout','authUserController@logout');

    Route::get('user-register','authUserController@registerIndex')->middleware('redirectIfLogIn');
    Route::post('user-register','authUserController@register')->middleware('redirectIfLogIn');
    Route::get('verify-user','authUserController@getVerifyUser')->name('verify');
    Route::post('verify-user','authUserController@verifyUser');

    Route::get('verify-phone','authUserController@getVerifyPhone');
    Route::post('verify-phone','authUserController@verifyPhone');

    Route::get('forget-password','authUserController@getForgetPassword')->name('forget');;
    Route::post('forget-password','authUserController@forgetPassword');
});


