<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin' , 'middleware' => 'auth'], function() {

    Route::get('get-profile/{id?}','HomeController@getProfile');
    Route::post('get-profile/{id?}','HomeController@updateProfile')->name('updateProfile');
    // Route::get('get-register','HomeController@getRegister')->name('updateProfile');
    // Route::post('get-register','HomeController@Register')->name('adminRegister');
    // Route::get('get-admins','HomeController@getAllAdmins');
    // Route::delete('delete-admin/{id}','HomeController@deleteAdmin');
    Route::get('/changePassword','HomeController@showChangePasswordForm');
    Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

    Route::post('markAllAsRead','controller@markAllAsRead');
    Route::post('markAllAsReadNoti','controller@markAllAsReadNoti');
  
    
    Route::namespace('admin')->group(function (){
        Route::get('/','indexController@indexdash');
        Route::resource('course', 'coursesController');
        // Online Courses
        Route::resource('courseOnline', 'onlineCourseController');
        // Institute 
        Route::resource('institute', 'instituteController');
        //all student
        Route::resource('student', 'studentController');
        Route::get('studentSt/{id}/{st}','studentController@studentStatus');
        //reservations
        Route::resource('reservation', 'reservationsController')->except(['show']);
        Route::get('reservation/{reservation_id}/{mark?}', 'reservationsController@show');

        Route::get('confirmReservation','reservationsController@allConfirmReservation');
        Route::post('reservation-session','reservationsController@reservattionSession');
        Route::get('add-reservation/{course_id}','reservationsController@reservationCourseDetails'); 
        Route::get('cancelReservation','reservationsController@allCancelReservation');
        Route::get('/confirmStatus/{id}','reservationsController@statusConfirm');
        Route::get('/cancelStatus/{id}','reservationsController@statusCancel');
        // Mobile App 
        Route::get('advertisement','websiteController@getAd');
        Route::put('advertisement','websiteController@editAd');
        // Website data
        Route::get('website-information','websiteController@getInfo');
        Route::put('website-information','websiteController@editInfo');
        // Social Media
        Route::get('social','websiteController@getSocial');
        Route::put('social/{socail_id}','websiteController@editSocial');
        // Static Pages
        Route::get('pages','websiteController@getPages');
        Route::get('pages/{page_id}/edit','websiteController@getEditPage');
        Route::put('pages/{page_id}','websiteController@editPage');
        //Contact Us module
        Route::get('messages/{modal?}','websiteController@getMessages');
        Route::get('sent-messages','websiteController@getSentMessages');
        Route::post('reply-message/{message_id}','websiteController@replyMsg');
        Route::delete('delete-message/{message_id}','websiteController@deleteMsg');
        // Route::get('send-message','websiteController@getSendMsg');
        // Route::post('send-message','websiteController@sendMsg');

        //Password Resests Module
        Route::get('password-reset','websiteController@allResets');
        Route::delete('password-reset/{reset_id}','websiteController@deleteReset');
        // Partners
        Route::resource('partners', 'partnersController');
        // Course Types
        Route::resource('course-types', 'courseTypesController');
        // Terms And Condtiitons
        Route::resource('terms-conditions', 'termsController');
        // Slider
        Route::resource('slider', 'sliderController');

        // notes
        Route::post('editNote/{id}/{noteId}','studentController@editNote');
        Route::delete('deleteNote/{id}/{noteId}','studentController@deleteNote');
        Route::post('addNote/{id}','studentController@addNote');
        // location
        Route::resource('location', 'locationController');
        Route::post('addCountry','locationController@storeCoutry');
        Route::get('country','locationController@createCountry');
        Route::delete('deleteCountry/{id}', 'locationController@destroyCountry');
        Route::put('updateCity/{id}','locationController@updateCity');
        Route::get('showCity/{id}','locationController@showCity');
        // gallery
        Route::resource('gallery', 'galleryController');
        Route::get('allVideos','galleryController@getAllvideos');
        // form add video
        Route::get('galleryVedio','galleryController@createVedio');
        // add video
        Route::post('addVedio','galleryController@storeVedio');
        // edit video
        Route::get('editVideo/{id}','galleryController@showVedio');
        // update video
        Route::put('updateVideo/{id}','galleryController@updateVedio');
        // delete video
        Route::delete('deleteVideo/{id}','galleryController@destroyVideo');
        // bank account
        Route::resource('bankAccount', 'bankAccountController');
    });
      // Dashboard
    


   



});

