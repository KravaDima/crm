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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/products'], function () {
    Route::get('/', 'ProductController@index')->name('products');
    Route::post('/set-product', 'ProductController@setProduct')->name('set-product');
    Route::post('/del-product', 'ProductController@delProduct')->name('del-product');
    Route::post('/edit-product', 'ProductController@getProduct')->name('edit-product');
    Route::post('/get-all-products', 'ProductController@getAllProducts')->name('get-all-products');
    Route::post('/add-product-incoming', 'ProductController@addProductIncoming')->name('add-product-incoming');
});

Route::group(['prefix' => '/counterparty'], function () {
    Route::get('/', 'CounterpartyController@index')->name('counterparty');
    Route::post('/set-counterparty', 'CounterpartyController@setCounterparty')->name('set-counterparty');
    Route::post('/del-counterparty', 'CounterpartyController@delCounterparty')->name('del-counterparty');
    Route::post('/edit-counterparty', 'CounterpartyController@getCounterparty')->name('edit-counterparty');
});

Route::group(['prefix' => '/incoming-payment-order'], function () {
    Route::get('/', 'IncomingPaymentOrderController@index')->name('incoming-payment-order');
    Route::post('/set-incoming-payment-order', 'IncomingPaymentOrderController@setIncomingPaymentOrder')->name('set-incoming-payment-order');
    Route::post('/del-incoming-payment-order', 'IncomingPaymentOrderController@delIncomingPaymentOrder')->name('del-incoming-payment-order');
    Route::post('/edit-incoming-payment-order', 'IncomingPaymentOrderController@getIncomingPaymentOrder')->name('edit-incoming-payment-order');
});

Route::get('/incoming-payment-order', 'IncomingPaymentOrderController@index')->name('incoming-payment-order');
Route::get('/outgoing-payment-order', 'OutgoingPaymentOrderController@index')->name('outgoing-payment-order');
