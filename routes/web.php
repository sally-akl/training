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
  Route::get('trainers','Dashboard\TrainerAreaController@index');
  Route::post('trainers/withdraw/add','Dashboard\TrainerAreaController@addwithdraw');
  Route::get('trainers/profile','Dashboard\TrainerAreaController@profile');
  Route::post('trainers/profile/edit','Dashboard\TrainerAreaController@update');
  Route::get('trainers/clients','Dashboard\TrainerAreaController@clients');
  Route::get('trainers/clients/details/{id}','Dashboard\TrainerAreaController@client_details');
  Route::get('trainers/programmes/design/{day}/{package_id}/{user_id?}','Dashboard\ProgrammeDesignController@index');
  Route::get('trainers/programmes/save/{type}/{id}','Dashboard\ProgrammeDesignController@addprogramme');
  Route::post('trainers/programmes/add','Dashboard\ProgrammeDesignController@createplan');
  Route::get('trainers/programmes/detaills/{id}','Dashboard\ProgrammeDesignController@show');
  Route::get('trainers/programmes/delete/{day}/{package_id}/{programme_id}/{user_id?}','Dashboard\ProgrammeDesignController@destroy');
  Route::resource('sections','Dashboard\SectionController');
  Route::group(['prefix'=>'recepies'],function () {
    Route::get('/',['uses'=>'Dashboard\RecepiesController@index']);
    Route::get('create',['uses'=>'Dashboard\RecepiesController@create']);
    Route::post('/store',['before' => 'csrf','uses'=>'Dashboard\RecepiesController@store']);
    Route::get('/{id}/edit',['uses'=>'Dashboard\RecepiesController@edit']);
    Route::post('/{id}',['before' => 'csrf','uses'=>'Dashboard\RecepiesController@update']);
    Route::get('index/{id}',['uses'=>'Dashboard\RecepiesController@destroy']);
    Route::get('select/integration/{id}',['uses'=>'Dashboard\RecepiesController@select_integration']);
  });
  Route::get('trainers/receips/delete/{day}/{package_id}/{programme_id}/{section}/{user_id?}','Dashboard\ProgrammeDesignController@destroy_receps');
  Route::get('trainers/receps/detaills/{id}','Dashboard\ProgrammeDesignController@show_receps');
  Route::get('packages/programmedesign/{id}','Dashboard\TrainerAreaController@showprogramme');




});
Auth::routes();
