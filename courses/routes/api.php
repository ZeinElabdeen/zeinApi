<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//  student register
Route::post('/register','APIS\authApiController@register');
//  verfiy student phone or mail
Route::post('/verify-user','APIS\authApiController@verifyUser')->middleware('checkAuth:done');
//  resend code verification
Route::post('/resend-verification-code','APIS\authApiController@resendActivation')->middleware('checkAuth:done');
//  login student
Route::post('/authenticate/{fcm_token?}','APIS\authApiController@login');
//   verify student phone incase of forgetting passwrod
Route::post('/verify-phone','APIS\authApiController@verifyPhoneForget');
//  set a new password
Route::post('/set-new-password','APIS\authApiController@setNewPass');

//  get profile route
Route::post('/profile','APIS\authApiController@profile')->middleware('checkAuth:done');
//  updadte profile route
Route::post('/profile-update','APIS\authApiController@updateProfile')->middleware('checkAuth:done');
//  change password route
Route::post('/change-password','APIS\authApiController@changePassword')->middleware('checkAuth:done');
//  logout student
Route::post('/user-logout','APIS\authApiController@logout')->middleware('checkAuth:done');


/* courses Routes */


//  get  all courses with pagination                  => if authenticated
Route::get('/get-courses','APIS\coursesApiController@get_courses_pagination')->middleware('checkAuth');
//  get  single course details                        => if authenticated
Route::post('/get-cousre-details','APIS\coursesApiController@courseDetails')->middleware('checkAuth');
//  get search courses page
Route::get('/course-search-page','APIS\coursesApiController@getPageCourseSearch')->middleware('checkAuth');
//  get  search result for courses                     => if authenticated
Route::get('/search-in-courses','APIS\coursesApiController@courseSearch')->middleware('checkAuth');
//  set  course rate
Route::post('/course-rate','APIS\coursesApiController@courseRate')->middleware('checkAuth:done');
//  get  wishlist page
Route::post('/wishlist','APIS\coursesApiController@wishlistPage')->middleware('checkAuth:done');
//  set  wishlist
Route::post('/add-wishlist','APIS\coursesApiController@addWish')->middleware('checkAuth:done');
//  global course search
Route::get('/global-search','APIS\coursesApiController@globalSearch')->middleware('checkAuth');
//  get search courses page                   
Route::get('/global-search-page','APIS\coursesApiController@getPageGlobalSearch')->middleware('checkAuth');



/* institutes Routes */


//  get  all institutes with pagination               => if authenticated
Route::get('/get-institutes','APIS\institutesApiController@get_institutes_pagination')->middleware('checkAuth');
//  get  single institute details                     => if authenticated
Route::post('/get-institute-details','APIS\institutesApiController@instituteDetails')->middleware('checkAuth');
//  get  search result for institutes                     => if authenticated
Route::get('/search-in-institutes','APIS\institutesApiController@instituteSearch')->middleware('checkAuth');
//  get  search page for institutes                     => if authenticated
Route::get('/institute-search-page','APIS\institutesApiController@getPageInstituteSearch')->middleware('checkAuth');
//  set  institute rate
Route::post('/institute-rate','APIS\institutesApiController@instituteRate')->middleware('checkAuth:done');


/* reservation Routes */


Route::post('/reservation','APIS\reservationApiController@reserve')->middleware('checkAuth:done');
/*  show  current reservation*/
Route::post('/current-reservations','APIS\reservationApiController@CurrentReservations')->middleware('checkAuth:done');
/*  show  last reservation*/
Route::post('/last-reservations','APIS\reservationApiController@LastReservation')->middleware('checkAuth:done');
/*  show  reservation details*/
Route::post('/reservation-details','APIS\reservationApiController@reservationsDetails')->middleware('checkAuth:done');
/*  send  invoice */
Route::post('/send-invoice','APIS\reservationApiController@SendInvoice')->middleware('checkAuth:done');


/* pages Routes  */


//  get  static pages
Route::post('/static-pages','APIS\pagesApiController@staticPages')->middleware('checkAuth');
//  all  notes
Route::get('/all-notes','APIS\pagesApiController@allNotes')->middleware('checkAuth:done');
//  note  details
Route::post('/note-details','APIS\pagesApiController@noteDetails')->middleware('checkAuth:done');
//  add  note
Route::post('/add-note','APIS\pagesApiController@addNote')->middleware('checkAuth:done');
//  edit  note
Route::post('/edit-note','APIS\pagesApiController@editNote')->middleware('checkAuth:done');
//  delete  note
Route::post('/delete-note','APIS\pagesApiController@deleteNote')->middleware('checkAuth:done');
//  get  photos gallery
Route::get('/photos','APIS\pagesApiController@getPhotos')->middleware('checkAuth');
//  get  videos gallery
Route::get('/videos','APIS\pagesApiController@getVideos')->middleware('checkAuth');
//  get  terms and condtions
Route::get('/terms-condtions','APIS\pagesApiController@termsAndCondition')->middleware('checkAuth');
//  send contact us message
Route::post('/contact-us','APIS\pagesApiController@contactUs')->middleware('checkAuth:done');
//  get contact us page
Route::get('/contact-us','APIS\pagesApiController@getContactUs')->middleware('checkAuth:done');
//  get  bank accounts 
Route::get('/bank-accounts','APIS\pagesApiController@bankAccounts')->middleware('checkAuth:done');
// get socail media
Route::get('/social-media','APIS\pagesApiController@socailMedia');

/* get notifications */

Route::get('/all-online-users','APIS\authApiController@allUsers');

Route::post('/save-fcm','APIS\authApiController@saveFCM')->middleware('checkAuth:done');
Route::post('/change-lang','APIS\authApiController@changeLang')->middleware('checkAuth:done');
Route::post('/all-noti','APIS\authApiController@allNotifications')->middleware('checkAuth:done');


// Route::get('/test-fcm','APIS\authApiController@testNotify')->middleware('checkAuth:done');



// Route::post('/task','taskController@createApi');