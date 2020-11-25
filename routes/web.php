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

Route::group(['before' => 'auth.basic','prefix'=>'dashboard'],function () {
  Route::get('/',['uses'=>'Dashboard\DashboardController@index']);
  Route::resource('country','Dashboard\CountryController');
  Route::resource('user','Dashboard\UserController');
  Route::resource('trainer','Dashboard\TrainerController');
  Route::post('uploadImage/{id}','Dashboard\TrainerController@uploadImage');
  Route::resource('package','Dashboard\PackageController');
  Route::resource('booking','Dashboard\BookingController');
  Route::get('bookings/{id}','Dashboard\BookingController@getTrainerBookings');
  Route::get('sales','Dashboard\BookingController@sales');
  Route::resource('category','Dashboard\CategoryController');
  Route::resource('subadmin','Dashboard\SubAdminController');
  Route::resource('notifications','Dashboard\NotificationsController');
  Route::get('notify/send/{id}','Dashboard\NotificationsController@senfNotify');
  Route::resource('support','Dashboard\SupportController');
  Route::resource('programme','Dashboard\ProgrammeController');
  Route::post('programmes/uploadImage','Dashboard\ProgrammeController@uploadImage');
  Route::post('messages/send','Dashboard\SupportController@sendMessage');
  Route::post('bookings/programme/{id}','Dashboard\BookingController@getBookingProgrammes');
  Route::resource('programmeimage','Dashboard\ProgrammeImagesController');


});
Auth::routes();
