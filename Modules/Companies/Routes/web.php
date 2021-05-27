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

	Route::get('companies', [
		'as'   => 'companies.index',
		'uses' => 'CompaniesController@index',
	]);

	Route::post('companies', [
		'as'   => 'companies.index',
		'uses' => 'CompaniesController@index',
	]);	

	Route::post('companies/add-companies',[
	  'as'   => 'companies.store',
		'uses' => 'CompaniesController@store',
	]);

	Route::get('companies/update-companies/{id}',[
		'as'	 =>'companies.edit',
		'uses' =>'CompaniesController@edit',
	]);

	Route::patch('companies/update-companies/{id}',[
		'as'	 =>'companies.update',
		'uses' =>'CompaniesController@update',
	]);

	Route::delete('companies/delete-companies/{id}',[
		'as'	 =>'companies.destroy',
		'uses' =>'CompaniesController@destroy',
	]);

	Route::get('companies-download-format', [
		'as'   => 'companies.download.format',
		'uses' => 'CompaniesController@downloadFormat',
	]);	

	Route::post('companies/import-companies',[
	  'as'   => 'companies.import',
		'uses' => 'CompaniesController@import',
	]);

});

