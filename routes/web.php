<?php

use Illuminate\Support\Facades\Route;

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
	'middleware' => ['web'],
	'prefix' 	 => ''], function() {

	Route::get('', [
		'as'   		=> 'homepages.index',
		'uses' 		=> 'App\Http\Controllers\HomepagesController@index',
	]);

});

Route::group([
	'middleware' => ['web', 'auth', 'verified_admin'],
	'prefix' 	 => 'dashboard'], function() {

	Route::get('', [
		'as'   		 => 'dashboard.index',
		'uses' 		 => 'App\Http\Controllers\DashboardController@index',
	]);

});

Route::group([
	'middleware' => ['web', 'auth', 'verified_admin'],
	'prefix' 		 => 'dashboard'], function() {

	Route::get('companies', [
		'as'   => 'companies.index',
		'uses' => 'App\Http\Controllers\CompaniesController@index',
	]);

	Route::post('companies', [
		'as'   => 'companies.index',
		'uses' => 'App\Http\Controllers\CompaniesController@index',
	]);	

	Route::post('companies/add-companies',[
	  'as'   => 'companies.store',
		'uses' => 'App\Http\Controllers\CompaniesController@store',
	]);

	Route::get('companies/update-companies/{id}',[
		'as'	 => 'companies.edit',
		'uses' => 'App\Http\Controllers\CompaniesController@edit',
	]);

	Route::patch('companies/update-companies/{id}',[
		'as'	 => 'companies.update',
		'uses' => 'App\Http\Controllers\CompaniesController@update',
	]);

	Route::delete('companies/delete-companies/{id}',[
		'as'	 => 'companies.destroy',
		'uses' => 'App\Http\Controllers\CompaniesController@destroy',
	]);

	Route::get('companies-download-format', [
		'as'   => 'companies.download.format',
		'uses' => 'App\Http\Controllers\CompaniesController@downloadFormat',
	]);	

	Route::post('companies/import-companies',[
	  'as'   => 'companies.import',
		'uses' => 'App\Http\Controllers\CompaniesController@import',
	]);

});

Route::group([
	'middleware' => ['web', 'auth', 'verified_admin'],
	'prefix' 		 => 'dashboard'], function() {

	Route::get('employees', [
		'as'   => 'employees.index',
		'uses' => 'App\Http\Controllers\EmployeesController@index',
	]);

	Route::post('employees', [
		'as'   => 'employees.index',
		'uses' => 'App\Http\Controllers\EmployeesController@index',
	]);	

	Route::post('employees/add-employees',[
	  'as'   => 'employees.store',
		'uses' => 'App\Http\Controllers\EmployeesController@store',
	]);

	Route::get('employees/update-employees/{id}',[
		'as'	 => 'employees.edit',
		'uses' => 'App\Http\Controllers\EmployeesController@edit',
	]);

	Route::patch('employees/update-employees/{id}',[
		'as'	 => 'employees.update',
		'uses' => 'App\Http\Controllers\EmployeesController@update',
	]);

	Route::delete('employees/delete-employees/{id}',[
		'as'	 => 'employees.destroy',
		'uses' => 'App\Http\Controllers\EmployeesController@destroy',
	]);

	Route::get('employees-download-format', [
		'as'   => 'employees.download.format',
		'uses' => 'App\Http\Controllers\EmployeesController@downloadFormat',
	]);	

	Route::post('employees/import-employees',[
	  'as'   => 'employees.import',
		'uses' => 'App\Http\Controllers\EmployeesController@import',
	]);

	Route::get('employees/data-employees/{id}',[
		'as'	 =>'employees.data',
		'uses' => 'App\Http\Controllers\EmployeesController@data_company',
	]);

});

/*searching filter*/

  Route::get('reference-search', [
    'as'   =>'reference.search',
    'uses' => 'App\Http\Controllers\ReferenceController@search',
  ]);

/*end of searching filter*/

Auth::routes([
	'verify' => false,
	'reset' => false,
	'login' => true,
	'logout' => true,
	'register' => false	
]);
