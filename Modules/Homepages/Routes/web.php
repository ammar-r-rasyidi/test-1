<?php

Route::group([
	'middleware' => ['web'],
	'prefix' 	 => ''], function() {

	Route::get('', [
		'as'   		 => 'homepages.index',
		'uses' 		 => 'HomepagesController@index',
	]);

});

