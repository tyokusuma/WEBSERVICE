<?php

use Illuminate\Http\Request;

//--------------------------- BUANG ----------------------------------------------
Route::post('users/password/reset/{token}', 'User\UserController@reset');
Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
Route::resource('messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store']]);
Route::get('mainservices', 'MainService\MainServiceController@show'); //Buat services
//----------------------------------------------------------------------------------


Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('users/password/forgot/{id}', 'User\UserController@sendResetLinkEmail');
Route::resource('users', 'User\UserController', ['only' => ['store']]);
Route::get('users/{id}/verify/{token}', 'User\UserController@verify')->name('verify');
Route::get('users/{id}/resend', 'User\UserController@resend')->name('resend');


//----------------------------- TERMS -------------------------------------------------
Route::get('termsApp', 'Other\OtherController@termsApp'); // belum ada 

//---------------------------------- INVITE FRIENDS -----------------------------------
// Route::post('contactCheck/{id}', 'User\UserController@contactCheck');

//------------------------------ CITY ------------------------------------------------
Route::get('city', 'City\CityController@index');
Route::post('city/search', 'City\CityController@searchByName');
//------------------------------ PROVINCE ----------------------------------------
Route::get('province', 'Province\ProvinceController@index');
Route::post('province/search', 'Province\ProvinceController@searchByName');

Route::group(['middleware' => ['auth:api']],function () {
	//------------------------------- BANK & PAYMENT ----------------------------------------
	Route::get('banks', 'Bank\BankController@index');
	Route::post('payments', 'Payment\PaymentController@store');


	Route::get('appSetting', 'Other\OtherController@setting');

	Route::resource('ads', 'Advertisement\AdvertisementController', ['only' => ['index', 'update']]);

	Route::resource('categories', 'Category\CategoryController', ['only' => ['index']]);

	//--------------------------------------- USER API ----------------------------------------------------------
	Route::group(['middleware' => ['user_expired']], function() {
		//---------------------------- FCM --------------------------------------------------
		Route::post('buyers/fcm', 'FCM\FCMController@store');
		Route::patch('buyers/fcm/{user_id}', 'FCM\FCMController@update');

		Route::get('buyers', 'User\UserController@show');
		Route::patch('buyers', 'User\UserController@update');
		Route::patch('buyers/changePassword', 'User\UserController@changePassword');
		Route::patch('buyers/gps', 'User\UserController@gps');

		Route::get('buyers/messages', 'Message\MessageController@getMessageById');
		Route::resource('buyers/messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
		Route::get('buyers/messages-details/{id}', 'MessageDetail\MessageDetailController@getMessageDetailById');
		Route::post('buyers/messages-details', 'MessageDetail\MessageDetailController@store');

		Route::resource('buyers/favorites', 'Favorite\FavoriteController', ['only' => ['store', 'destroy']]);
		Route::get('buyers/favorites', 'Favorite\FavoriteController@getFavoriteById');

		// Route::get('buyers/transactions', 'Transaction\TransactionController@getByIdBuyers');
		// Route::get('buyers/transactions/booking', 'Transaction\TransactionController@getByIdBookingBuyers');
		// Route::get('buyers/transactions/non-booking', 'Transaction\TransactionController@getByIdNonBookingBuyers');

		// Route::post('mainservices/available', 'MainService\MainServiceController@available');
		
		// Route::post('services/findTaksi', 'Service\ServiceController@findTaksi');
		// Route::post('services/findAbang', 'Service\ServiceController@findAbang');

		// Route::post('buyers/transactions', 'Transaction\TransactionController@store');
		// Route::patch('buyers/transactions', 'Transaction\TransactionController@update');

		// Route::patch('transactions/{id}/cancel', 'Transaction\TransactionController@cancel');
		
	});

	//----------------------------------- PROVIDER API -------------------------------------------------------
	Route::group(['middleware' => ['provider_expired']], function() {
		Route::post('mainservices/services', 'Service\ServiceController@store');
		Route::patch('mainservices/services', 'Service\ServiceController@update'); 

		Route::post('mainservices/fcm', 'FCM\FCMController@store');
		Route::patch('mainservices/fcm/{user_id}', 'FCM\FCMController@update');

		Route::get('mainservices', 'MainService\MainServiceController@show');
		Route::patch('mainservices', 'User\UserController@update');
		Route::patch('mainservices/changePassword', 'User\UserController@changePassword');
		Route::patch('mainservices/gps', 'User\UserController@gps');

		Route::get('mainservices/messages', 'Message\MessageController@getMessageById');
		Route::resource('mainservices/messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
		Route::get('mainservices/messages-details/{id}', 'MessageDetail\MessageDetailController@getMessageDetailById');
		Route::resource('mainservices/messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store']]);

		// Route::patch('mainservices/transactions', 'Transaction\TransactionController@update');

		// Route::get('mainservices/transactions', 'Transaction\TransactionController@getByIdServices');
		// Route::get('mainservices/transactions/booking', 'Transaction\TransactionController@getByIdBookingServices');
		// Route::get('mainservices/transactions/non-booking', 'Transaction\TransactionController@getByIdNonBookingServices');
		// Route::get('mainservices/transactions/today', 'Transaction\TransactionController@getByIdandDateForService');
		// Route::patch('mainservices/transactions/priority', 'Transaction\TransactionController@updatePriority');


		
		Route::get('armadas', 'Armada\ArmadaController@index');

	});

});
