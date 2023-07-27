<?php

use App\Http\Controllers\Shop\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('home');
});*/
Route::get('/','App\Http\Controllers\Shop\MainController@index');
//Product Routes
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products/create',  'App\Http\Controllers\ProductController@create');
Route::post('/products', 'App\Http\Controllers\ProductController@store');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('products.show');
Route::get('/products/{product}/edit', 'App\Http\Controllers\ProductController@edit');
Route::put('/products/{product}', 'App\Http\Controllers\ProductController@update');
Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy');

//Client Routes
Route::get('/clients', 'App\Http\Controllers\ClientController@index')->name('clients.index');
Route::get('/clients/create', 'App\Http\Controllers\ClientController@create')->name('clients.create');
Route::post('/clients', 'App\Http\Controllers\ClientController@store')->name('clients.store');
Route::get('/clients/{client}', 'App\Http\Controllers\ClientController@show')->name('clients.show');
Route::get('/clients/{client}/edit', 'App\Http\Controllers\ClientController@edit')->name('clients.edit');
Route::put('/clients/{client}', 'App\Http\Controllers\ClientController@update')->name('clients.update');
Route::delete('/clients/{client}', 'App\Http\Controllers\ClientController@destroy')->name('clients.destroy');

//Order Routes
Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('orders.index');
Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('orders.create');
Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('orders.store');
Route::get('/orders/{orders}', 'App\Http\Controllers\OrderController@show')->name('orders.show');
Route::get('/orders/{orders}/edit', 'App\Http\Controllers\OrderController@edit')->name('orders.edit');
Route::put('/orders/{orders}', 'App\Http\Controllers\OrderController@update')->name('orders.update');
Route::delete('/orders/{orders}', 'App\Http\Controllers\OrderController@destroy')->name('orders.destroy');
