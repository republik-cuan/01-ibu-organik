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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('/hello', 'HomeController@index')->name('hello');

Route::group([
  'as' => 'admin',
  'prefix' => 'admin',
], function () {
  Route::get('/', 'AdminController@index');
  Route::post('/', 'AdminController@store')->name('.store');
  Route::get('/{id}', 'AdminController@edit')->name('.edit');
  Route::put('/{id}', 'AdminController@update')->name('.update');
  Route::delete('/{id}', 'AdminController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'item',
  'prefix' => 'item',
], function () {
  Route::get('/', 'ItemController@index');
  Route::post('/', 'ItemController@store')->name('.store');
  Route::get('/{id}', 'ItemController@edit')->name('.edit');
  Route::put('/{id}', 'ItemController@update')->name('.update');
  Route::delete('/{id}', 'ItemController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'customer',
  'prefix' => 'customer',
], function () {
  Route::get('/', 'CustomerController@index');
  Route::post('/', 'CustomerController@store')->name('.store');
  Route::get('/{id}', 'CustomerController@edit')->name('.edit');
  Route::put('/{id}', 'CustomerController@update')->name('.update');
  Route::delete('/{id}', 'CustomerController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'purchase',
  'prefix' => 'purchase',
], function () {
  Route::get('/', 'PurchaseController@index');
  Route::post('/', 'PurchaseController@store')->name('.store');
  Route::get('/{id}', 'PurchaseController@edit')->name('.edit');
  Route::put('/{id}', 'PurchaseController@update')->name('.update');
  Route::delete('/{id}', 'PurchaseController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'category',
  'prefix' => 'category',
], function () {
  Route::get('/', 'CategoryController@index');
  Route::get('/create', 'CategoryController@create')->name('.create');
  Route::post('/', 'CategoryController@store')->name('.store');
  Route::get('/{id}', 'CategoryController@edit')->name('.edit');
  Route::put('/{id}', 'CategoryController@update')->name('.update');
  Route::delete('/{id}', 'CategoryController@destroy')->name('.destroy');
});

Route::group([
  'as' => 'supplier',
  'prefix' => 'supplier',
], function () {
  Route::get('/', 'SupplierController@index');
  Route::get('/create', 'SupplierController@create')->name('.create');
  Route::post('/', 'SupplierController@store')->name('.store');
  Route::get('/{id}', 'SupplierController@edit')->name('.edit');
  Route::put('/{id}', 'SupplierController@update')->name('.update');
  Route::delete('/{id}', 'SupplierController@destroy')->name('.destroy');
});
