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
  Route::get('/nopermission',['uses'=>'Dashboard\NoPermssonController@nopermission']);
  Route::resource('country','Dashboard\CountryController');
  Route::resource('user','Dashboard\UserController');
  Route::resource('trainer','Dashboard\TrainerController');
  Route::post('uploadImage/{id}','Dashboard\TrainerController@uploadImage');
  Route::post('/categores/uploadImage/{id}','Dashboard\CategoryController@uploadImage');
  Route::resource('package','Dashboard\PackageController');
  Route::resource('booking','Dashboard\BookingController');
  Route::get('bookings/{id}','Dashboard\BookingController@getTrainerBookings');
  Route::get('sales','Dashboard\ReportController@sales');
  Route::resource('category','Dashboard\CategoryController');
  Route::resource('subadmin','Dashboard\SubAdminController');
  Route::resource('slider','Dashboard\SliderController');
  Route::resource('muscles','Dashboard\MusclesController');
  Route::resource('exercisetype','Dashboard\ExerciseTypeController');
  Route::resource('equipment','Dashboard\EquipmentController');
  Route::resource('mechanicstype','Dashboard\MechanicsTypeController');
  Route::resource('level','Dashboard\LevelController');
  Route::resource('questions','Dashboard\QuestionsController');
  Route::resource('readyplanpackage','Dashboard\ReadyplanpackageController');

  Route::resource('readyplan','Dashboard\ReadyplanController');
  Route::post('readyplans/excer/get','Dashboard\ReadyplanController@get_excercise_div');
  Route::post('readyplans/supplement/get','Dashboard\ReadyplanController@get_supplement_div');
  Route::post('readyplans/meals/get','Dashboard\ReadyplanController@get_meals_div');
  Route::get('readyplans/programmes/save/{type}/{id}','Dashboard\ReadyplanController@addprogramme');
  Route::get('readyplans/plans/get/{day}','Dashboard\ReadyplanController@get_plans');

  Route::post('sliders/uploadImage/{id}','Dashboard\SliderController@uploadImage');
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
  Route::get('trainers/programmes/days/{week}/{transaction}/{package_id}/{user_id?}','Dashboard\ProgrammeDesignController@days');
  Route::get('trainers/programmes/design/{day}/{week}/{transaction}/{package_id}/{user_id?}','Dashboard\ProgrammeDesignController@index');
  Route::get('trainers/programmes/save/{type}/{id}','Dashboard\ProgrammeDesignController@addprogramme');
  Route::post('trainers/programmes/add','Dashboard\ProgrammeDesignController@createplan');
  Route::get('trainers/programmes/detaills/{id}','Dashboard\ProgrammeDesignController@show');
  Route::get('trainers/programmes/delete/{id}','Dashboard\ProgrammeDesignController@destroy');
  Route::post('trainers/programmes/copy','Dashboard\ProgrammeDesignController@copy');
  Route::post('trainers/programmes/copyweek','Dashboard\ProgrammeDesignController@copyweek');
  Route::post('trainers/programmes/copyday','Dashboard\ProgrammeDesignController@copyday');

  Route::get('readypackage/weeks/{id}','Dashboard\ReadyplanpackageController@weeks');
  Route::get('readypackage/days/{week}/{transaction}','Dashboard\ReadyplanpackageController@days');
  Route::get('readypackage/programmes/design/{day}/{week}/{transaction}','Dashboard\ReadyplanpackageController@design');
  Route::post('readypackage/programmes/add','Dashboard\ReadyplanpackageController@createplan');
  Route::get('readypackage/programmes/save/{type}/{id}','Dashboard\ReadyplanpackageController@addprogramme');
  Route::get('readypackage/programmes/delete/{id}','Dashboard\ReadyplanpackageController@delete');

  Route::get('readypackage/plans/get/{day}','Dashboard\ReadyplanController@get_plans');
  Route::get('readypackage/plans/days/select/{day}/{plan}','Dashboard\ReadyplanController@get_plans_days');
  Route::get('readypackage/receips/delete/{id}','Dashboard\ReadyplanpackageController@delete');


  Route::get('trainersarea/clients/details/{id}','Dashboard\TrainerAreaController@trainer_client_details');
  Route::post('trainersarea/programmes/get','Dashboard\TrainerAreaController@trainer_get_search');
  Route::get('/trainersarea/get/excercies/{id}/{trans}',['uses'=>'Dashboard\TrainerAreaController@get_excercise_byday']);
  Route::get('/trainersarea/get/suppliment/{id}/{trans}',['uses'=>'Dashboard\TrainerAreaController@get_suppliment_byday']);
  Route::get('/trainersarea/get/food/{id}/{trans}',['uses'=>'Dashboard\TrainerAreaController@get_food_byday']);
  Route::post('trainersarea/suppliment/get','Dashboard\TrainerAreaController@trainer_get_search_suppliment');
  Route::post('trainersarea/recepe/get','Dashboard\TrainerAreaController@recepe_trainer_get_search');
  Route::post('trainersarea/ready/copy','Dashboard\TrainerAreaController@copy_ready_plan');


  Route::post('trainers/questionair/answer','Dashboard\TrainerAreaController@add_answer');
  Route::resource('sections','Dashboard\SectionController');
  Route::group(['prefix'=>'recepies'],function () {
    Route::get('/',['uses'=>'Dashboard\RecepiesController@index']);
    Route::get('create',['uses'=>'Dashboard\RecepiesController@create']);
    Route::post('/store',['before' => 'csrf','uses'=>'Dashboard\RecepiesController@store']);
    Route::get('/{id}/edit',['uses'=>'Dashboard\RecepiesController@edit']);
    Route::post('/{id}',['before' => 'csrf','uses'=>'Dashboard\RecepiesController@update']);
    Route::get('index/{id}',['uses'=>'Dashboard\RecepiesController@destroy']);
    Route::get('select/integration/{id}',['uses'=>'Dashboard\RecepiesController@select_integration']);
    Route::post('/trainer/store',['uses'=>'Dashboard\RecepiesController@storerecepe']);
  });
  Route::get('trainers/receips/delete/{id}','Dashboard\ProgrammeDesignController@destroy');
  Route::get('trainers/receps/detaills/{id}','Dashboard\ProgrammeDesignController@show_receps');
  Route::get('packages/programmedesign/{id}','Dashboard\TrainerAreaController@showprogramme');
  Route::get('usersarea/subscrips','Dashboard\UserAreaController@subscrips');
  Route::get('usersarea/subscrips/details/{id}','Dashboard\UserAreaController@subscrip_details');
  Route::post('chat/save','Dashboard\DashboardController@chat');
});

Route::get('/lang/{lang}',['uses'=>'HomeController@lang']);

Route::middleware(['XSS','web','Localization'])->group(function () {

  Route::get('/',['uses'=>'HomeController@index']);
  Route::get('/trainer/{id}/{details}',['uses'=>'HomeController@trainer_details']);
  Route::get('/auth-customer',['uses'=>'HomeController@login']);
  Route::post('/signin',['uses'=>'HomeController@sign_in']);
  Route::get('/my-subscription',['uses'=>'HomeController@usersubscribe']);
  Route::post('/signout',['uses'=>'HomeController@sign_out']);
  Route::get('/auth-customer-signup',['uses'=>'HomeController@signup']);
  Route::post('/signup',['uses'=>'HomeController@submit_signup']);
  Route::get('/edit-profile',['uses'=>'HomeController@profile']);
  Route::post('/edit',['uses'=>'HomeController@edit_profile']);
  Route::get('/tickets',['uses'=>'HomeController@tickets']);
  Route::get('/ticket/{id}/{subject}',['uses'=>'HomeController@ticket_details']);
  Route::post('/savemessage',['uses'=>'HomeController@save_ticket_message']);
  Route::post('/addticket',['uses'=>'HomeController@addticket']);
  Route::get('/my-subscription/details/{id}',['uses'=>'HomeController@usersubscribe_details']);
  Route::get('/get/weekday/{id}',['uses'=>'HomeController@weekdays']);
  Route::get('/get/excercies/{id}/{trans}',['uses'=>'HomeController@get_excercise_byday']);
  Route::get('/get/suppliment/{id}/{trans}',['uses'=>'HomeController@get_suppliment_byday']);
  Route::get('/get/food/{id}/{trans}',['uses'=>'HomeController@get_food_byday']);
  Route::get('/checkout/{name}/{id}',['uses'=>'HomeController@checkout']);
  Route::get('/payment/{type}/{id}',['uses'=>'HomeController@payment']);
  Route::post('paypal', array('as' => 'paypal','uses' => 'PayPalController@postPaymentWithpaypal'));
  Route::get('paypal', array('as' => 'paypal.status','uses' => 'PayPalController@getPaymentStatus'));
  Route::get('/strip/pay/{type}/{id}',['uses'=>'StripeController@payform']);
  Route::post('stripe', array('as' => 'pay.stripe','uses' => 'StripeController@postPaymentStripe'));
  Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
  Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
  Route::get('auth/apple', 'Auth\LoginController@redirectToApple');
  Route::get('auth/apple/callback', 'Auth\LoginController@handleAppleCallback');
  Route::post('/chat/image/save',['uses'=>'HomeController@save_image_chat']);
  Route::post('/add/excercise/complete',['uses'=>'HomeController@complete_excercise']);
  Route::get('/subscribe/questions/{id}',['uses'=>'HomeController@subscribequestions']);
  Route::post('/subscribe/add',['uses'=>'HomeController@complete_subscribequestions']);

});
Auth::routes();
