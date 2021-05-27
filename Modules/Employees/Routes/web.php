<?php

/*!
* Copyright 2020
* Authors : ammar rizal rasyidi
* Authors Email : (ammar.r.rasyidi@gmail.com)
* Licensed under Personal Use License

* The content owner grants the buyer a non-exclusive, perpetual, personal use
* license to view, download, display, and copy the content, subject to the
* following restrictions:

* The content is licensed for personal use only, not commercial use. The
* content may not be used in any way whatsoever in which you charge money,
* collect fees, or receive any form of remuneration. The content may not be
* resold, relicensed, sub-licensed, rented, leased, or used in advertising.

* Title and ownership, and all rights now and in the future, of and for the
* content remain exclusively with the content owner.

* There are no warranties, express or implied. The content is provided 'as
* is.'

* Neither the content owner, payment processing service, nor hosting service
* will be liable for any third party claims or incidental, consequential, or
* other damages arising out of this license or the buyer's use of the content. */



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


Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' 		 => 'dashboard'], function() {

	Route::get('employees', [
		'as'   => 'employees.index',
		'uses' => 'EmployeesController@index',
	]);

	Route::post('employees', [
		'as'   => 'employees.index',
		'uses' => 'EmployeesController@index',
	]);	

	Route::post('employees/add-employees',[
	  'as'   => 'employees.store',
		'uses' => 'EmployeesController@store',
	]);

	Route::get('employees/update-employees/{id}',[
		'as'	 =>'employees.edit',
		'uses' =>'EmployeesController@edit',
	]);

	Route::patch('employees/update-employees/{id}',[
		'as'	 =>'employees.update',
		'uses' =>'EmployeesController@update',
	]);

	Route::delete('employees/delete-employees/{id}',[
		'as'	 =>'employees.destroy',
		'uses' =>'EmployeesController@destroy',
	]);

	Route::get('employees-download-format', [
		'as'   => 'employees.download.format',
		'uses' => 'EmployeesController@downloadFormat',
	]);	

	Route::post('employees/import-employees',[
	  'as'   => 'employees.import',
		'uses' => 'EmployeesController@import',
	]);

	Route::get('employees/data-employees/{id}',[
		'as'	 =>'employees.data',
		'uses' =>'EmployeesController@data_company',
	]);


});

