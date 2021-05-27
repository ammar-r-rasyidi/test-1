<?php
use Illuminate\Support\Facades\Route;

Route::group([
	'middleware' => ['web'],
	'prefix' 		 => ''], function() {

	Route::get('login', [
		'as'   => 'login',
		'uses' => 'LoginController@showLoginForm',
	]);	

	Route::post('login', [
		'as'   => 'login.post',
		'uses' => 'LoginController@login',
	]);	

	Route::post('logout', [
		'as'   => 'logout',
		'uses' => 'LoginController@logout',
	]);	

	// Route::get('register', [
	// 	'as'   => 'register.index',
	// 	'uses' => 'RegisterController@showRegistrationForm',
	// ]);	

	// Route::post('sign-up', [
	// 	'as'   => 'sign.up.post',
	// 	'uses' => 'RegisterController@register',
	// ]);	

	// Route::get('forgot-password', [
	// 	'as'   => 'forgot.password.index',
	// 	'uses' => 'ForgotPasswordController@showLinkRequestForm',
	// ]);	

	// Route::post('forgot-password', [
	// 	'as'   => 'reset.password.post',
	// 	'uses' => 'ForgotPasswordController@sendResetLinkEmail',
	// ]);	

	// Route::get('reset-password/{token}', [
	// 	'as'   => 'password.reset',
	// 	'uses' => 'ResetPasswordController@showResetForm',
	// ]);	

	// Route::post('reset-password', [
	// 	'as'   => 'password.update',
	// 	'uses' => 'ResetPasswordController@reset',
	// ]);	

});

Auth::routes([
	'verify' => true,
	'reset' => true,
	'login' => false,
	'logout' => false,
	'register' => false	
]);

