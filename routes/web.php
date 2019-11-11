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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  $about = [
    [
      'icon' => 'fas fa-apple-alt',
      'label' => 'Alami',
      'description' => 'Sayuran tumbuh diladang sendiri dan tanpa memakai bahan pengawet'
    ],
    [
      'icon' => 'fas fa-wallet',
      'label' => 'Terjangkau',
      'description' => 'Harga dari produk kami tidak berdasarkan merk, namun kami menyesuaikan harga pasar'
    ],
    [
      'icon' => 'fas fa-smile',
      'label' => 'Ramah',
      'description' => 'Penjual dan para staf yang ramah akan siap melayani pesanan anda'
    ],
    [
      'icon' => 'fas fa-handshake',
      'label' => 'Terpercaya',
      'description' => 'Poin diatas merupakan bukti '
    ],
  ];

  $items = range(1, 8);

  return view('welcome', [
    'about' => $about,
    'items' => $items,
  ]);
});

Auth::routes();

Route::group([
  'middleware' => 'auth:web'
], function() {
  Route::get('dashboard', 'HomeController@index')->name('home');
  Route::group([
    'as' => 'admin',
    'can' => 'super-admin',
    'prefix' => 'admin',
    'middleware' => 'check-role',
  ], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/trash', 'AdminController@trash')->name('.trash');
    Route::post('/', 'AdminController@store')->name('.store');
    Route::get('/create', 'AdminController@create')->name('.create');
    Route::get('/{id}', 'AdminController@edit')->name('.edit');
    Route::put('/{id}', 'AdminController@update')->name('.update');
    Route::put('/trash/{id}', 'AdminController@restore')->name('.restore');
    Route::delete('/{id}', 'AdminController@destroy')->name('.destroy');
    Route::delete('/trash/{id}', 'AdminController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'item',
    'prefix' => 'item',
    'middleware' => 'check-role',
  ], function () {
    Route::get('/', 'ItemController@index');
    Route::get('/trash','ItemController@trash')->name('.trash');
    Route::post('/', 'ItemController@store')->name('.store');
    Route::get('/create', 'ItemController@create')->name('.create');
    Route::get('/{id}', 'ItemController@edit')->name('.edit');
    Route::put('/{id}', 'ItemController@update')->name('.update');
    Route::put('/trash/{id}','ItemController@restore')->name('.restore');
    Route::delete('/{id}', 'ItemController@destroy')->name('.destroy');
    Route::delete('/trash/{id}','ItemController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'category',
    'prefix' => 'category',
  ], function () {
    Route::get('/', 'CategoryController@index');
    Route::get('/trash', 'CategoryController@trash')->name('.trash');
    Route::post('/', 'CategoryController@store')->name('.store');
    Route::get('/create', 'CategoryController@create')->name('.create');
    Route::get('/{id}', 'CategoryController@edit')->name('.edit');
    Route::put('/{id}', 'CategoryController@update')->name('.update');
    Route::put('/trash/{id}', 'CategoryController@restore')->name('.restore');
    Route::delete('/{id}', 'CategoryController@destroy')->name('.destroy');
    Route::delete('/trash/{id}', 'CategoryController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'customer',
    'prefix' => 'customer',
  ], function () {
    Route::get('/', 'CustomerController@index');
    Route::post('/', 'CustomerController@store')->name('.store');
    Route::get('/create', 'CustomerController@create')->name('.create');
    Route::get('/{id}', 'CustomerController@edit')->name('.edit');
    Route::put('/{id}', 'CustomerController@update')->name('.update');
    Route::delete('/{id}', 'CustomerController@destroy')->name('.destroy');
    Route::delete('/trash', 'CustomerController@trash')->name('.trash');
    Route::delete('/trash/{id}', 'CustomerController@destroypermanent')->name('.destroypermanent');
    Route::delete('/trash/{id}', 'CustomerController@restore')->name('.restore');
  });

  Route::group([
    'as' => 'purchase',
    'prefix' => 'purchase',
  ], function () {
    Route::get('/', 'PurchaseController@index');
    Route::post('/', 'PurchaseController@store')->name('.store');
    Route::get('/create', 'PurchaseController@create')->name('.create');
    Route::get('/{id}', 'PurchaseController@edit')->name('.edit');
    Route::get('/{id}/add', 'PurchaseController@add')->name('.add');
    Route::put('/{id}', 'PurchaseController@update')->name('.update');
    Route::delete('/{id}', 'PurchaseController@destroy')->name('.destroy');
  });


  Route::group([
    'as' => 'supplier',
    'prefix' => 'supplier',
  ], function () {
    Route::get('/', 'SupplierController@index');
    Route::get('/trash', 'SupplierController@trash')->name('.trash');
    Route::post('/', 'SupplierController@store')->name('.store');
    Route::get('/create', 'SupplierController@create')->name('.create');
    Route::get('/{id}', 'SupplierController@edit')->name('.edit');
    Route::put('/{id}', 'SupplierController@update')->name('.update');
    Route::put('/trash/{id}', 'SupplierController@restore')->name('.restore');
    Route::delete('/{id}', 'SupplierController@destroy')->name('.destroy');
    Route::delete('/trash/{id}', 'SupplierController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'invoice',
    'prefix' => 'invoice',
  ], function () {
    Route::get('/', 'InvoiceController@index');
    Route::post('/', 'InvoiceController@store')->name('.store');
    Route::get('/create', 'InvoiceController@create')->name('.create');
    Route::get('/{id}', 'InvoiceController@edit')->name('.edit');
    Route::put('/{id}', 'InvoiceController@update')->name('.update');
    Route::delete('/{id}', 'InvoiceController@destroy')->name('.destroy');
  });

  Route::group([
    'as' => 'sales',
    'prefix' => 'sales',
  ], function () {
    Route::get('/', 'SalesController@index');
    Route::get('/trash', 'SalesController@trash')->name('.trash');
    Route::post('/', 'SalesController@store')->name('.store');
    Route::get('/create', 'SalesController@create')->name('.create');
    Route::get('/{id}', 'SalesController@edit')->name('.edit');
    Route::put('/{id}', 'SalesController@update')->name('.update');
    Route::put('/trash/{id}', 'SalesController@restore')->name('.restore');
    Route::delete('/{id}', 'SalesController@destroy')->name('.destroy');
    Route::delete('/trash/{id}', 'SalesController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'inventories',
    'prefix' => 'inventories',
  ], function() {
    Route::post('/', 'ItemPurchaseController@store')->name('.store');
    Route::get('/{id}', 'ItemPurchaseController@print')->name('.print');
    Route::put('/{id}', 'ItemPurchaseController@verified')->name('.verified');
    Route::delete('/{id}', 'ItemPurchaseController@destroy')->name('.destroy');
  });

  Route::group([
    'as' => 'bank',
    'prefix' => 'bank',
  ], function () {
    Route::get('/', 'BankController@index');
    Route::get('/trash', 'BankController@trash')->name('.trash');
    Route::post('/', 'BankController@store')->name('.store');
    Route::get('/create', 'BankController@create')->name('.create');
    Route::get('/{id}', 'BankController@edit')->name('.edit');
    Route::put('/{id}', 'BankController@update')->name('.update');
    Route::put('/trash/{id}', 'BankController@restore')->name('.restore');
    Route::delete('/{id}', 'BankController@destroy')->name('.destroy');
    Route::delete('/trash/{id}', 'BankController@destroypermanent')->name('.destroypermanent');
  });

  Route::group([
    'as' => 'rekap',
    'prefix' => 'rekap',
    'middleware' => 'check-role',
  ], function() {
    Route::get('/item', 'RekapController@item')->name('.item');
    Route::post('/item', 'RekapController@itemExport')->name('.export-item');
    Route::get('/month', 'RekapController@month')->name('.monthly');
    Route::post('/month', 'RekapController@monthExport')->name('.export-month');
  });
});
