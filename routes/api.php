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
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
Route::post('users/password/forgot/{id}', 'User\UserController@sendResetLinkEmail');
Route::post('users/password/reset/{token}', 'User\UserController@reset');
Route::resource('users', 'User\UserController', ['only' => ['store']]);
Route::get('users/{id}/verify/{token}', 'User\UserController@verify')->name('verify');
Route::get('users/{id}/resend', 'User\UserController@resend')->name('resend');
// Route::post('users/password/change_password/{id}', 'User\UserController@changePassword');
Route::group(['middleware' => ['expired']],function () {

	Route::resource('users', 'User\UserController', ['only' => ['show', 'update']]);

	Route::get('buyers', 'Buyer\BuyerController@show');
	Route::get('buyers/transactions', 'Transaction\TransactionController@getByIdBuyers');
	Route::get('buyers/transactions/booking', 'Transaction\TransactionController@getByIdBookingBuyers');
	Route::get('buyers/transactions/non-booking', 'Transaction\TransactionController@getByIdNonBookingBuyers');
	Route::get('buyers/messages', 'Message\MessageController@getBuyerMessageById');
	Route::get('buyers/messages-details/{id}', 'MessageDetail\MessageDetailController@getBuyerMessageDetailById');
	Route::get('buyers/favorites', 'Favorite\FavoriteController@getFavoriteById');
	Route::get('buyers/services/available/{subcategory}', 'MainService\MainServiceController@index');

	Route::post('mainservices/available', 'MainService\MainServiceController@available');
	Route::get('mainservices', 'MainService\MainServiceController@show');
	Route::get('mainservices/transactions', 'Transaction\TransactionController@getByIdServices');
	Route::get('mainservices/transactions/booking', 'Transaction\TransactionController@getByIdBookingServices');
	Route::get('mainservices/transactions/non-booking', 'Transaction\TransactionController@getByIdNonBookingServices');
	Route::get('mainservices/transactions/today', 'Transaction\TransactionController@getByIdandDateForService');
	//New route
	Route::patch('mainservices/transactions/priority', 'Transaction\TransactionController@updatePriority');
	//
	Route::get('mainservices/messages', 'Message\MessageController@getServiceMessageById');
	Route::get('mainservices/messages-details/{id}', 'MessageDetail\MessageDetailController@getServiceMessageDetailById');


	Route::resource('services', 'Service\ServiceController', ['only' => ['store', 'update']]);
	Route::post('services/findTaksi', 'Service\ServiceController@findTaksi');
	Route::post('services/findAbang', 'Service\ServiceController@findAbang');

	Route::resource('transactions', 'Transaction\TransactionController', ['only' => ['store', 'update']]);
	Route::patch('transactions/{id}/cancel', 'Transaction\TransactionController@cancel');


	Route::resource('favorites', 'Favorite\FavoriteController', ['only' => ['store', 'destroy']]);

	Route::resource('categories', 'Category\CategoryController', ['only' => ['index']]);

	Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'show', 'destroy']]);
	Route::resource('messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store']]);

	Route::resource('ads', 'Advertisement\AdvertisementController', ['only' => ['index', 'update']]);
	Route::get('city', 'City\CityController@index');
	Route::post('city/search', 'City\CityController@searchByName');

	Route::get('province', 'Province\ProvinceController@index');
	Route::post('province/search', 'Province\ProvinceController@searchByName');

	Route::get('apps_setting', 'Other\OtherController@show');

	// New route
	Route::get('termsApp', 'Other\OtherController@termsApp');

	Route::get('armadas', 'Armada\ArmadaController@index');

	Route::post('testingSchedule', 'Other\OtherController@testing'); //testing pusher
});