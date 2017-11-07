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
Route::get('terms', 'Term\TermWebController@terms')->name('terms');
Route::prefix('adminpanel')->group(function () {
	Route::get('/', 'Other\OtherWebController@slash');
	Route::get('login', 'Auth\LoginController@redirectLogin')->name('login');
	Route::post('login', 'Auth\LoginController@login');

	Route::group(['middleware' => ['auth']],function () {
		
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

		Route::get('serviceDetails', 'Service\ServiceWebController@index')->name('view-servicedetails');
		Route::get('serviceDetails/add', 'Service\ServiceWebController@create')->name('view-create-servicedetails');
		Route::post('serviceDetails/add', 'Service\ServiceWebController@store')->name('create-servicedetails');
		Route::get('serviceDetails/{id}', 'Service\ServiceWebController@getImages')->name('get-images');
		Route::get('serviceDetails/update/{id}', 'Service\ServiceWebController@edit')->name('view-update-servicedetails');
		Route::patch('serviceDetails/update/{id}', 'Service\ServiceWebController@update')->name('update-servicedetails');
		Route::patch('serviceDetails/suspend/{id}', 'Service\ServiceWebController@suspend')->name('suspend-service');
		Route::delete('serviceDetails/delete/{id}', 'Service\ServiceWebController@destroy')->name('delete-servicedetails');

		Route::get('tags', 'Tag\TagController@index')->name('view-tags');
		Route::get('tags/add', 'Tag\TagController@create')->name('view-create-tags');
		Route::post('tags/add', 'Tag\TagController@store')->name('create-tags');
		Route::get('tags/update/{id}', 'Tag\TagController@edit')->name('view-update-tags');
		Route::patch('tags/update/{id}', 'Tag\TagController@update')->name('update-tags');
		Route::delete('tags/delete/{id}', 'Tag\TagController@destroy')->name('delete-tags');

		Route::get('categories', 'Category\CategoryWebController@index')->name('view-categories');
		Route::get('categories/add', 'Category\CategoryWebController@create')->name('view-create-categories');
		Route::post('categories/add', 'Category\CategoryWebController@store')->name('create-categories');
		Route::get('categories/update/{id}', 'Category\CategoryWebController@edit')->name('view-update-categories');
		Route::patch('categories/update/{id}', 'Category\CategoryWebController@update')->name('update-categories');
		Route::delete('categories/delete/{id}', 'Category\CategoryWebController@destroy')->name('delete-categories');

		Route::get('inbox', 'Message\MessageWebController@index')->name('view-inbox');
		Route::get('inbox/add', 'Message\MessageWebController@create')->name('view-create-inbox');
		Route::post('inbox/add', 'Message\MessageWebController@store')->name('create-inbox');
		// Route::patch('inbox/update/{id}', 'Message\MessageWebController@update')->name('update-inbox');
		Route::delete('inbox/delete/{id}', 'Message\MessageWebController@destroy')->name('delete-inbox');

		Route::get('inboxDetail/{id_message}/{user_id}/{full_name}', 'MessageDetail\MessageDetailWebController@getDetail')->name('view-inbox-details');
		Route::post('inboxDetail/add', 'MessageDetail\MessageDetailWebController@store')->name('create-inbox-detail');

		Route::get('armadas', 'Armada\ArmadaWebController@index')->name('view-armadas');
		Route::get('armadas/add', 'Armada\ArmadaWebController@create')->name('view-create-armadas');
		Route::post('armadas/add', 'Armada\ArmadaWebController@store')->name('create-armadas');
		Route::get('armadas/update/{id}', 'Armada\ArmadaWebController@edit')->name('view-update-armadas');
		Route::patch('armadas/update/{id}', 'Armada\ArmadaWebController@update')->name('update-armadas');
		Route::delete('armadas/delete/{id}', 'Armada\ArmadaWebController@destroy')->name('delete-armadas');
		
		// Route::get('provinces', 'Province\ProvinceWebController@index')->name('view-provinces');
		// Route::get('provinces/add', 'Province\ProvinceWebController@create')->name('view-create-provinces');
		// Route::post('provinces/add', 'Province\ProvinceWebController@store')->name('create-provinces');
		// Route::get('provinces/update/{id}', 'Province\ProvinceWebController@edit')->name('view-update-provinces');
		// Route::patch('provinces/update/{id}', 'Province\ProvinceWebController@update')->name('update-provinces');
		// Route::delete('provinces/delete/{id}', 'Province\ProvinceWebController@destroy')->name('delete-provinces');

		Route::get('cities', 'City\CityWebController@index')->name('view-cities');
		Route::get('cities/add', 'City\CityWebController@create')->name('view-create-cities');
		Route::post('cities/add', 'City\CityWebController@store')->name('create-cities');
		Route::get('cities/update/{id}', 'City\CityWebController@edit')->name('view-update-cities');
		Route::patch('cities/update/{id}', 'City\CityWebController@update')->name('update-cities');
		Route::delete('cities/delete/{id}', 'City\CityWebController@destroy')->name('delete-cities');

		Route::get('ads', 'Advertisement\AdvertisementWebController@index')->name('view-ads'); 
		Route::get('ads/create', 'Advertisement\AdvertisementWebController@create')->name('view-create-ads');
		Route::post('ads/create', 'Advertisement\AdvertisementWebController@store')->name('create-ads');
		Route::get('ads/update/{id}', 'Advertisement\AdvertisementWebController@edit')->name('view-update-ads');
		Route::patch('ads/update/{id}', 'Advertisement\AdvertisementWebController@update')->name('update-ads');
		Route::delete('ads/delete/{id}', 'Advertisement\AdvertisementWebController@destroy')->name('delete-ads');

		Route::get('graphics', 'Graph\GraphWebController@create')->name('view-create-graphs');
		Route::get('graphics_create', 'Graph\GraphWebController@show')->name('create-graphs');
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
		Route::get('notifications', 'Other\OtherWebController@notifications')->name('all-notifications');

		Route::get('trackingMap/currentLat={current_lat}&currentLng={current_lng}&lastLat={last_lat}&lastLng={last_lng}', 'Other\OtherWebController@map')->name('tracking-map');

		Route::get('payments', 'Payment\PaymentWebController@index')->name('view-index-payments');
		Route::get('confirmPayment/{id}', 'Payment\PaymentWebController@edit')->name('view-update-payments');
		Route::patch('confirmPayment/{id}/userId={user_id}', 'Payment\PaymentWebController@update')->name('update-payments');

		Route::get('bank', 'Bank\BankWebController@index')->name('view-index-bank');
		Route::get('bankCreate', 'Bank\BankWebController@create')->name('view-create-bank');
		Route::post('bankCreate', 'Bank\BankWebController@store')->name('create-bank');
		Route::get('bankUpdate/{id}', 'Bank\BankWebController@edit')->name('view-update-bank');
		Route::patch('bankUpdate/{id}', 'Bank\BankWebController@update')->name('update-bank');
		Route::delete('bankDelete/{id}', 'Bank\BankWebController@destroy')->name('delete-bank');

		Route::get('term', 'Term\TermWebController@index')->name('view-index-term');
		Route::get('termCreate', 'Term\TermWebController@create')->name('view-create-term');
		Route::post('termCreate', 'Term\TermWebController@store')->name('create-term');
		Route::get('termUpdate/{id}', 'Term\TermWebController@edit')->name('view-update-term');
		Route::patch('termUpdate/{id}', 'Term\TermWebController@update')->name('update-term');
		Route::delete('termDelete', 'Term\TermWebController@destroy')->name('delete-term');
		Route::get('termPreview/{id}', 'Term\TermWebController@preview')->name('preview-term');

		Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	});
});

		// Route::get('favorites', 'Favorite\FavoriteWebController@index')->name('view-favorites');
		// Route::get('services', 'MainService\MainServiceWebController@index')->name('services-only');
