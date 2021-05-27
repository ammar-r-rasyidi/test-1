<?php

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' 	 => 'dashboard'], function() {

	Route::get('', [
		'as'   		 => 'dashboard.index',
		'uses' 		 => 'DashboardController@index',
	]);

});

