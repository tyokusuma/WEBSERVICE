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

// Authentication Routes...
// $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
// $this->post('login', 'Auth\LoginController@login');
// $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('users/verify/{token}', 'User\UserWebController@verify')->name('verify');
Route::get('error-401', function() {
	return view('layouts.error.master_error');
})->name('error-401');

Route::prefix('adminpanel')->group(function () {
	Route::get('/', function() {
		return redirect()->route('login');
	});
	Route::get('login', function() {
		if (Auth::check()) {
			return redirect()->route('dashboard');
		}
		return view('layouts.web.login');
	})->name('login');
	Route::post('login', 'Auth\LoginController@login');

	Route::middleware('auth')->group(function () {
		Route::post('logout', 'Auth\LoginController@logout')->name('logout');
		Route::get('dashboard', function() {
			return view('layouts.web.dashboard');
		})->name('dashboard');

		Route::get('users', 'User\UserWebController@index')->name('view-users');
		Route::get('users/add', 'User\UserWebController@create')->name('view-create-users');
		Route::post('users/add', 'User\UserWebController@store')->name('create-users');
		Route::patch('users/update/{id}', 'User\UserWebController@update')->name('update-users');

		Route::get('servicedetails', 'Service\ServiceWebController@index')->name('view-servicedetails');
		Route::get('servicedetails/add', 'Service\ServiceWebController@create')->name('view-create-servicedetails');
		Route::post('servicedetails/add', 'Service\ServiceWebController@store')->name('create-servicedetails');
		Route::patch('servicedetails/update/{id}', 'Service\ServiceWebController@update')->name('update-servicedetails');
		Route::get('servicedetails/{id}', 'Service\ServiceWebController@getImages')->name('get-images');

		Route::get('categories', 'Category\CategoryWebController@index')->name('view-categories');
		Route::get('categories/add', 'Category\CategoryWebController@create')->name('view-create-categories');
		Route::post('categories/add', 'Category\CategoryWebController@store')->name('create-categories');		
		Route::patch('categories/update/{id}', 'Category\CategoryWebController@update')->name('update-categories');
		Route::delete('categories/delete/{id}', 'Category\CategoryWebController@destroy')->name('delete-categories');


		Route::get('inbox', 'Message\MessageWebController@index')->name('view-inbox');
		Route::get('inbox/add', 'Message\MessageWebController@create')->name('view-create-inbox');
		Route::post('inbox/add', 'Message\MessageWebController@store')->name('create-inbox');
		Route::patch('inbox/update/{id}', 'Message\MessageWebController@update')->name('update-inbox');
		Route::delete('inbox/delete/{id}', 'Message\MessageWebController@destroy')->name('delete-inbox');

		Route::get('inbox-detail/{id}/{user_id}/{full_name}', 'MessageDetail\MessageDetailWebController@getDetail')->name('view-inbox-details');
		Route::post('inbox-detail/add', 'MessageDetail\MessageDetailWebController@store')->name('create-inbox-detail');

		Route::get('misc/{id}', 'Other\OtherController@create')->name('view-edit-others');
		Route::patch('misc/{id}', 'Other\OtherController@store')->name('edit-others');
		

		Route::get('armadas', 'Armada\ArmadaWebController@index')->name('view-armadas');
		Route::get('armadas/add', 'Armada\ArmadaWebController@create')->name('view-create-armadas');
		Route::post('armadas/add', 'Armada\ArmadaWebController@store')->name('create-armadas');
		Route::patch('armadas/update/{id}', 'Armada\ArmadaWebController@update')->name('update-armadas');
		Route::delete('armadas/delete/{id}', 'Armada\ArmadaWebController@destroy')->name('delete-armadas');
		
		Route::get('provinces', 'Province\ProvinceController@index')->name('view-provinces');
		Route::get('provinces/add', 'Province\ProvinceController@create')->name('view-create-provinces');
		Route::post('provinces/add', 'Province\ProvinceController@store')->name('create-provinces');
		Route::patch('provinces/update/{id}', 'Province\ProvinceController@update')->name('update-provinces');
		Route::delete('provinces/delete/{id}', 'Province\ProvinceController@destroy')->name('delete-provinces');

		Route::get('transactions', 'Transaction\TransactionWebController@index')->name('view-transactions');
		Route::get('buyers', 'Buyer\BuyerWebController@index')->name('view-buyers');
	});
});
		// Route::get('favorites', 'Favorite\FavoriteWebController@index')->name('view-favorites');
		// Route::get('services', 'MainService\MainServiceWebController@index')->name('services-only');