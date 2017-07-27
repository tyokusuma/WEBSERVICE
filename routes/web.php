<?php

use App\CustomCollection;
use App\Events\NotificationEvent;
use Illuminate\Database\Query\paginate;
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

// Authentication Routes...
// $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
// $this->post('login', 'Auth\LoginController@login');
// $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('error-401', 'Other\OtherController@error401')->name('error-401');

Route::prefix('adminpanel')->group(function () {
	Route::get('/', 'Other\OtherController@slash');
	Route::get('login', 'Auth\LoginController@redirectLogin')->name('login');
	Route::post('login', 'Auth\LoginController@login');

	Route::group(['middleware' => ['auth']],function () {
		$idUser = Auth::user();
		Route::post('logout', 'Auth\LoginController@logout')->name('logout');

		// Route::resource('users', 'User\UserWebController', ['names' => [
		// 		'index' => 'view-users',
		// 		'create' => 'view-create-users',
		// 		'store' => 'create-users',
		// 		'update' => 'update-users'
		// 	]]);
		Route::get('users', 'User\UserWebController@index', ['idUser', $idUser])->name('view-users');
		Route::get('users/add', 'User\UserWebController@create')->name('view-create-users');
		Route::post('users/add', 'User\UserWebController@store')->name('create-users');
		Route::patch('users/update/{id}', 'User\UserWebController@update')->name('update-users');


		// Route::resource('servicedetails', 'Service\ServiceWebController', ['names' => [
		// 		'index' => 'view-servicedetails',
		// 		'create' => 'view-create-servicedetails',
		// 		'store' => 'create-servicedetails',
		// 		'update' => 'update-servicedetails'
		// 	]]);
		Route::get('servicedetails/{id}', 'Service\ServiceWebController@getImages')->name('get-images');
		Route::get('servicedetails', 'Service\ServiceWebController@index')->name('view-servicedetails');
		Route::get('servicedetails/add', 'Service\ServiceWebController@create')->name('view-create-servicedetails');
		Route::post('servicedetails/add', 'Service\ServiceWebController@store')->name('create-servicedetails');
		Route::patch('servicedetails/update/{id}', 'Service\ServiceWebController@update')->name('update-servicedetails');

		// Route::resource('categories', 'Category\CategoryWebController', ['names' => [
		// 		'index' => 'view-categories',
		// 		'create' => 'view-create-categories',
		// 		'store' => 'create-categories',
		// 		'update' => 'update-categories',
		// 		'destroy' => 'delete-categories'
		// 	]]);
		Route::get('categories', 'Category\CategoryWebController@index')->name('view-categories');
		Route::get('categories/add', 'Category\CategoryWebController@create')->name('view-create-categories');
		Route::post('categories/add', 'Category\CategoryWebController@store')->name('create-categories');
		Route::patch('categories/update/{id}', 'Category\CategoryWebController@update')->name('update-categories');
		Route::delete('categories/delete/{id}', 'Category\CategoryWebController@destroy')->name('delete-categories');

		// Route::resource('inbox', 'Message\MessageWebController', ['names' => [
		// 		'index' => 'view-inbox',
		// 		'create' => 'view-create-inbox',
		// 		'store' => 'create-inbox',
		// 		'update' => 'update-inbox',
		// 		'destroy' => 'delete-inbox'
		// 	]]);
		Route::get('inbox', 'Message\MessageWebController@index')->name('view-inbox');
		Route::get('inbox/add', 'Message\MessageWebController@create')->name('view-create-inbox');
		Route::post('inbox/add', 'Message\MessageWebController@store')->name('create-inbox');
		Route::patch('inbox/update/{id}', 'Message\MessageWebController@update')->name('update-inbox');
		Route::delete('inbox/delete/{id}', 'Message\MessageWebController@destroy')->name('delete-inbox');

		Route::get('inbox-detail/{id}/{user_id}/{full_name}', 'MessageDetail\MessageDetailWebController@getDetail')->name('view-inbox-details');
		Route::post('inbox-detail/add', 'MessageDetail\MessageDetailWebController@store')->name('create-inbox-detail');

		// Route::resource('armadas', 'Armada\ArmadaWebController', ['names' => [
		// 		'index' => 'view-armadas',
		// 		'create' => 'view-create-armadas',
		// 		'store' => 'create-armadas',
		// 		'update' => 'update-armadas',
		// 		'destroy' => 'delete-armadas'
		// 	]]);
		Route::get('armadas', 'Armada\ArmadaWebController@index')->name('view-armadas');
		Route::get('armadas/add', 'Armada\ArmadaWebController@create')->name('view-create-armadas');
		Route::post('armadas/add', 'Armada\ArmadaWebController@store')->name('create-armadas');
		Route::patch('armadas/update/{id}', 'Armada\ArmadaWebController@update')->name('update-armadas');
		Route::delete('armadas/delete/{id}', 'Armada\ArmadaWebController@destroy')->name('delete-armadas');
		
		// Route::resource('provinces', 'Province\ProvinceWebController', ['names' => [
		// 		'index' => 'view-provinces',
		// 		'create' => 'view-create-provinces',
		// 		'store' => 'create-provinces',
		// 		'update' => 'update-provinces',
		// 		'destroy' => 'delete-provinces'
		// 	]]);
		Route::get('provinces', 'Province\ProvinceWebController@index')->name('view-provinces');
		Route::get('provinces/add', 'Province\ProvinceWebController@create')->name('view-create-provinces');
		Route::post('provinces/add', 'Province\ProvinceWebController@store')->name('create-provinces');
		Route::patch('provinces/update/{id}', 'Province\ProvinceWebController@update')->name('update-provinces');
		Route::delete('provinces/delete/{id}', 'Province\ProvinceWebController@destroy')->name('delete-provinces');

		// Route::resource('cities', 'City\CityWebController', ['names' => [
		// 		'index' => 'view-cities',
		// 		'create' => 'view-create-cities',
		// 		'store' => 'create-cities',
		// 		'update' => 'update-cities',
		// 		'destroy' => 'delete-cities'
		// 	]]);
		Route::get('cities', 'City\CityWebController@index')->name('view-cities');
		Route::get('cities/add', 'City\CityWebController@create')->name('view-create-cities');
		Route::post('cities/add', 'City\CityWebController@store')->name('create-cities');
		Route::patch('cities/update/{id}', 'City\CityWebController@update')->name('update-cities');
		Route::delete('cities/delete/{id}', 'City\CityWebController@destroy')->name('delete-cities');

		// Route::resource('ads', 'Advertisement\AdvertisementWebController', ['except' => ['show', 'edit']]);

		// Route::resource('ads', 'Advertisement\AdvertisementWebController', ['names' => [
		// 		'index' => 'view-ads',
		// 		'create' => 'view-create-ads',
		// 		'store' => 'create-ads',
		// 		'update' => 'update-ads',
		// 		'destroy' => 'delete-ads'
		// 	]], ['except' => ['edit', 'show']]);
		Route::get('ads', 'Advertisement\AdvertisementWebController@index')->name('view-ads'); 
		Route::get('ads/create', 'Advertisement\AdvertisementWebController@create')->name('view-create-ads');
		Route::post('ads/create', 'Advertisement\AdvertisementWebController@store')->name('create-ads');
		Route::patch('ads/update/{id}', 'Advertisement\AdvertisementWebController@update')->name('update-ads');
		Route::delete('ads/delete/{id}', 'Advertisement\AdvertisementWebController@destroy')->name('delete-ads');

		Route::get('transactions', 'Transaction\TransactionWebController@index')->name('view-transactions');
		Route::get('buyers', 'Buyer\BuyerWebController@index')->name('view-buyers');
		
		Route::get('dashboard', 'Other\OtherController@dashboard')->name('dashboard');
		Route::get('misc/{id}', 'Other\OtherController@create')->name('view-edit-others');
		Route::post('misc/{id}', 'Other\OtherController@store')->name('edit-others');

		Route::get('markasread', 'Other\OtherController@markasread');
		Route::get('unread', 'Other\OtherController@unread')->name('unread-notifs');
		Route::get('/notifications', 'Other\OtherController@notifications')->name('all-notifications');
	});
});

		// Route::get('favorites', 'Favorite\FavoriteWebController@index')->name('view-favorites');
		// Route::get('services', 'MainService\MainServiceWebController@index')->name('services-only');
