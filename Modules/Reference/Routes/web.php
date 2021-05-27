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

/*searching filter*/

  Route::get('reference-search', [
    'as'   =>'reference.search',
    'uses' => 'ReferenceController@search',
  ]);

/*end of searching filter*/
