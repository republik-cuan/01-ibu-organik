<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
  'as' => 'api.admin',
  'prefix' => 'admin',
], function() {
  Route::get('/', 'ApiAdminController@index');
  Route::post('/', 'ApiAdminController@store')->name('.store');
});

Route::group([
  'as' => 'item',
  'prefix' => 'item',
], function() {
  Route::get('/', 'ItemController@index');
  Route::post('/', 'ItemController@store')->name('.store');
  Route::get('/{id}', 'ItemController@edit')->name('.show');
  Route::put('/{id}', 'ItemController@update')->name('.update');
  Route::delete('/{id}', 'ItemController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'customer',
  'prefix' => 'customer',
], function() {
  Route::get('/', 'CustomerController@index');
  Route::post('/', 'CustomerController@store')->name('.store');
  Route::get('/{id}', 'CustomerController@edit')->name('.edit');
  Route::put('/{id}', 'CustomerController@update')->name('.update');
  Route::delete('/{id}', 'CustomerController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'purchase',
  'prefix' => 'purchase',
], function() {
  Route::get('/', 'PurchaseController@index');
  Route::post('/', 'PurchaseController@store')->name('.store');
  Route::get('/{id}', 'PurchaseController@edit')->name('.edit');
  Route::put('/{id}', 'PurchaseController@update')->name('.update');
  Route::delete('/{id}', 'PurchaseController@destroy')->name('.destroy');
});
