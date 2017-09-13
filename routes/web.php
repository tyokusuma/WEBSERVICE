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
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('error-401', 'Other\OtherWebController@error401')->name('error-401');
Route::get('changePassword/{reset}', 'User\UserController@showReset')->name('verify-web');
Route::patch('confirmNewPassword/{reset}', 'User\UserController@reset')->name('change-pass');
Route::prefix('adminpanel')->group(function () {
	Route::get('/', 'Other\OtherWebController@slash');
	Route::get('login', 'Auth\LoginController@redirectLogin')->name('login');
	Route::post('login', 'Auth\LoginController@login');

	Route::group(['middleware' => ['auth']],function () {
		// $idUser = Auth::user();

		// Route::resource('users', 'User\UserWebController', ['names' => [
		// 		'index' => 'view-users',
		// 		'create' => 'view-create-users',
		// 		'store' => 'create-users',
		// 		'update' => 'update-users'
		// 	]]);
		// Route::get('users', 'User\UserWebController@index', ['idUser', $idUser])->name('view-users');
		Route::get('users', 'User\UserWebController@index')->name('view-users');
		Route::get('users/add', 'User\UserWebController@create')->name('view-create-users');
		Route::post('users/add', 'User\UserWebController@store')->name('create-users');
		Route::get('users/update/{id}', 'User\UserWebController@edit')->name('view-update-users');
		Route::patch('users/update/{id}', 'User\UserWebController@update')->name('update-users');

		Route::get('admins', 'User\UserWebController@indexAdmin')->name('view-admins');
		Route::get('admins/add', 'User\UserWebController@createAdmin')->name('view-create-admins');
		Route::post('admins/add', 'User\UserWebController@storeAdmin')->name('create-admins');
		Route::get('admins/update/{id}', 'User\UserWebController@editAdmin')->name('view-update-admins');
		Route::patch('admins/update/{id}', 'User\UserWebController@updateAdmin')->name('update-admins');
		Route::delete('admins/delete/{id}', 'User\UserWebController@destroyAdmin')->name('delete-admins');

		// Route::resource('servicedetails', 'Service\ServiceWebController', ['names' => [
		// 		'index' => 'view-servicedetails',
		// 		'create' => 'view-create-servicedetails',
		// 		'store' => 'create-servicedetails',
		// 		'update' => 'update-servicedetails'
		// 	]]);
		Route::get('servicedetails', 'Service\ServiceWebController@index')->name('view-servicedetails');
		Route::get('servicedetails/add', 'Service\ServiceWebController@create')->name('view-create-servicedetails');
		Route::get('servicedetails/{id}', 'Service\ServiceWebController@getImages')->name('get-images');
		Route::post('servicedetails/add', 'Service\ServiceWebController@store')->name('create-servicedetails');
		Route::get('servicedetails/update/{id}', 'Service\ServiceWebController@edit')->name('view-update-servicedetails');
		Route::patch('servicedetails/update/{id}', 'Service\ServiceWebController@update')->name('update-servicedetails');
		Route::patch('servicedetails/suspend/{id}', 'Service\ServiceWebController@suspend')->name('suspend-service');
		Route::delete('servicedetails/delete/{id}', 'Service\ServiceWebController@destroy')->name('delete-servicedetails');

		Route::get('tags', 'Tag\TagController@index')->name('view-tags');
		Route::get('tags/add', 'Tag\TagController@create')->name('view-create-tags');
		Route::post('tags/add', 'Tag\TagController@store')->name('create-tags');
		Route::get('tags/update/{id}', 'Tag\TagController@edit')->name('view-update-tags');
		Route::patch('tags/update/{id}', 'Tag\TagController@update')->name('update-tags');
		Route::delete('tags/delete/{id}', 'Tag\TagController@destroy')->name('delete-tags');

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
		Route::get('categories/update/{id}', 'Category\CategoryWebController@edit')->name('view-update-categories');
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
		// Route::patch('inbox/update/{id}', 'Message\MessageWebController@update')->name('update-inbox');
		Route::delete('inbox/delete/{id}', 'Message\MessageWebController@destroy')->name('delete-inbox');

		Route::get('inbox-detail/{id_message}/{user_id}/{full_name}', 'MessageDetail\MessageDetailWebController@getDetail')->name('view-inbox-details');
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
		Route::get('armadas/update/{id}', 'Armada\ArmadaWebController@edit')->name('view-update-armadas');
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
		Route::get('provinces/update/{id}', 'Province\ProvinceWebController@edit')->name('view-update-provinces');
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
		Route::get('cities/update/{id}', 'City\CityWebController@edit')->name('view-update-cities');
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
		Route::get('ads/update/{id}', 'Advertisement\AdvertisementWebController@edit')->name('view-update-ads');
		Route::patch('ads/update/{id}', 'Advertisement\AdvertisementWebController@update')->name('update-ads');
		Route::delete('ads/delete/{id}', 'Advertisement\AdvertisementWebController@destroy')->name('delete-ads');

		Route::get('graphics', 'Graph\GraphController@create')->name('view-create-graphs');
		Route::get('graphics_create', 'Graph\GraphController@show')->name('create-graphs');
		Route::get('transactions', 'Transaction\TransactionWebController@index')->name('view-transactions');
		Route::get('buyers', 'Buyer\BuyerWebController@index')->name('view-buyers');
		
		Route::get('others', 'Other\OtherWebController@index')->name('view-others');
		// Route::get('others/none', 'Other\OtherWebController@edit')->name('view-none');
		// Route::get('others/create', 'Other\OtherWebController@show')->name('view-create-others');
		Route::post('others/create', 'Other\OtherWebController@store')->name('create-others');
		// Route::get('others/update', 'Other\OtherWebController@viewUpdate')->name('view-update-others');
		Route::patch('others/update/{id}', 'Other\OtherWebController@update')->name('update-others');

		Route::get('dashboard', 'Other\OtherWebController@dashboard')->name('dashboard');
		Route::get('misc/{id}', 'Other\OtherWebController@create')->name('view-edit-others');
		Route::post('misc/{id}', 'Other\OtherWebController@store')->name('edit-others');

		Route::get('markasread', 'Other\OtherWebController@markasread');
		// Route::get('unread', 'Other\OtherWebController@unread')->name('unread-notifs');
		// Route::get('notifications', 'Other\OtherWebController@notifications')->name('all-notifications');

		Route::get('tracking-map/currentLat={current_lat}&currentLng={current_lng}&lastLat={last_lat}&lastLng={last_lng}', 'Other\OtherWebController@map')->name('tracking-map');

		Route::get('payments', 'Payment\PaymentWebController@index')->name('view-index-payments');
		Route::get('confirmPayment/{id}', 'Payment\PaymentWebController@edit')->name('view-update-payments');
		Route::patch('confirmPayment/{id}/userId={user_id}', 'Payment\PaymentWebController@update')->name('update-payments');

		Route::get('bank', 'Bank\BankWebController@index')->name('view-index-bank');
		Route::get('bank-create', 'Bank\BankWebController@create')->name('view-create-bank');
		Route::post('bank-create', 'Bank\BankWebController@store')->name('create-bank');
		Route::get('bank-update/{id}', 'Bank\BankWebController@edit')->name('view-update-bank');
		Route::patch('bank-update/{id}', 'Bank\BankWebController@update')->name('update-bank');
		Route::delete('bank-delete/{id}', 'Bank\BankWebController@destroy')->name('delete-bank');

		Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	});
});

		// Route::get('favorites', 'Favorite\FavoriteWebController@index')->name('view-favorites');
		// Route::get('services', 'MainService\MainServiceWebController@index')->name('services-only');
