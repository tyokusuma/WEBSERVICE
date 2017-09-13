<?php

use Illuminate\Http\Request;

//--------------------------- BUANG ----------------------------------------------
// Route::post('users/password/reset/{token}', 'User\UserController@reset');
// Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
// Route::resource('messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store']]);
// Route::get('mainservices', 'MainService\MainServiceController@show'); //Buat services
Route::get('testing', 'Transaction\TransactionController@testing');
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
	
	Route::get('armadas', 'Armada\ArmadaController@index');

	//--------------------------------------- USER API ----------------------------------------------------------
	Route::group(['middleware' => ['user_expired']], function() {
		Route::prefix('buyers')->group(function() {

			//---------------------------- FCM --------------------------------------------------
			Route::post('fcm', 'FCM\FCMController@store');
			Route::patch('fcm/{user_id}', 'FCM\FCMController@update');

			Route::get('buyers', 'User\UserController@show');
			Route::patch('buyers', 'User\UserController@update');
			Route::patch('changePassword', 'User\UserController@changePassword');

			Route::get('messages', 'Message\MessageController@getMessageById');
			Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
			Route::get('messages-details/{id}', 'MessageDetail\MessageDetailController@getMessageDetailById');
			Route::post('messages-details', 'MessageDetail\MessageDetailController@store');

			Route::resource('favorites', 'Favorite\FavoriteController', ['only' => ['store', 'destroy']]);
			Route::get('favorites', 'Favorite\FavoriteController@getFavoriteById');

			Route::post('transactions', 'Transaction\TransactionController@store');
			Route::patch('transactions/gps/{id_transaction}', 'Transaction\TransactionController@updateBuyer');
			Route::delete('transactions/delete', 'Transaction\TransactionController@destroyBuyer');
			Route::get('transactions/today', 'Transaction\TransactionController@todayBuyer');
			Route::get('transactions/history', 'Transaction\TransactionController@historyBuyer');
			Route::post('servicesAvailable', 'MainService\MainServiceController@available'); //untuk transaksi diitung radiusnya
			Route::post('findService', 'MainService\MainServiceController@searchService'); //fitur search
		});
		
	});

	//----------------------------------- PROVIDER API -------------------------------------------------------
	Route::group(['middleware' => ['provider_expired']], function() {
		Route::prefix('mainservices')->group(function() {

			Route::post('services', 'Service\ServiceController@store');
			Route::patch('services', 'Service\ServiceController@update'); 
			Route::patch('services/closed', 'Service\ServiceController@close');

			Route::post('fcm', 'FCM\FCMController@store');
			Route::patch('fcm/{user_id}', 'FCM\FCMController@update');

			Route::get('/', 'MainService\MainServiceController@show');
			Route::patch('/', 'User\UserController@update');
			Route::patch('changePassword', 'User\UserController@changePassword');

			Route::get('messages', 'Message\MessageController@getMessageById');
			Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'destroy']]);
			Route::get('messages-details/{id}', 'MessageDetail\MessageDetailController@getMessageDetailById');
			Route::resource('messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store']]);
		
			Route::patch('transactions/{id}', 'Transaction\TransactionController@updateService');
			Route::patch('transactions/gps/{id_transaction}', 'Transaction\TransactionController@updateService');
			Route::delete('transactions/delete', 'Transaction\TransactionController@destroyService');
			Route::get('transactions/today', 'Transaction\TransactionController@todayService');
			Route::get('transactions/history', 'Transaction\TransactionController@historyService');
			

		// Route::patch('mainservices/transactions/priority', 'Transaction\TransactionController@updatePriority'); //Route ini ga akan dipake dulu krn klopun dikasi priority, jamnya beda2

		});
	});

});
