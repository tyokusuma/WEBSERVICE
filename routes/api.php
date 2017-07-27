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


// Rekomendasi:
// Buat url path dalam bentuk jamak/plural


  // Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);

  // Route::resource('services', 'Service\ServiceController', ['except' => ['create', 'edit']]);

  // // Route::resource('transactions', 'Transaction\TransactionController', ['only' => ['update']]);

  // Route::resource('favorites', 'Favorite\FavoriteController', ['except' => ['create', 'edit']]);

  // Route::resource('categories', 'Category\CategoryController', ['except' => ['edit', 'create']]);


Route::resource('users', 'User\UserController', ['only' => ['store', 'show', 'update', 'index']]);
Route::post('users/password/reset/{token}', 'User\UserController@reset');

Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['show', 'index']]);
Route::get('buyers/transactions/{id}', 'Transaction\TransactionController@getByIdBuyers')->name('get-transactions-buyer');
Route::get('buyers/transactions/booking/{id}', 'Transaction\TransactionController@getByIdBookingBuyers')->name('get-transactions-buyer-type-booking');
Route::get('buyers/transactions/non-booking/{id}', 'Transaction\TransactionController@getByIdNonBookingBuyers')->name('get-transactions-buyer-type-now');


Route::resource('mainservices', 'MainService\MainServiceController', ['only' => ['show', 'index']]);
Route::get('mainservices/transactions/{id}', 'Transaction\TransactionController@getByIdServices')->name('get-transactions-service');
Route::get('mainservices/transactions/booking/{id}', 'Transaction\TransactionController@getByIdBookingServices')->name('get-transactions-service-type-booking');
Route::get('mainservices/transactions/non-booking/{id}', 'Transaction\TransactionController@getByIdNonBookingServices')->name('get-transactions-service-type-now');

Route::resource('services', 'Service\ServiceController', ['only' => ['show', 'store', 'update', 'index']]);

Route::resource('transactions', 'Transaction\TransactionController', ['except' => ['edit', 'create', 'update', 'destroy']]);


Route::resource('favorites', 'Favorite\FavoriteController', ['only' => ['show', 'store', 'destroy', 'index', 'update']]);

Route::resource('categories', 'Category\CategoryController', ['only' => ['show', 'index']]);

Route::resource('messages', 'Message\MessageController', ['only' => ['store', 'show', 'destroy', 'index']]);
Route::resource('messages-details', 'MessageDetail\MessageDetailController', ['only' => ['store', 'show', 'destroy', 'index']]);

// Route::get('messages', 'Message\MessageController@index');
// Route::post('messages', 'Message\MessageController@store');
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend')->get('users/{id}/resend', 'User\UserController@resend');
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
// Route::get('ads', 'Advertisement\AdvertisementController', ['only' => 'index']);