<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\MainController;
use Illuminate\Support\Facades\Auth;


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
Route::middleware('guest')->group(function () {
    // Routes that non-authenticated users can access.
    Route::get('/shop/add-to-cart','App\Http\Controllers\Shop\MainController@add');

    // Additional routes for guests...
});


//Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Admin-only routes here...
    //Product Routes
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');
Route::get('/products/create',  'App\Http\Controllers\ProductController@create')->name('products.create');
Route::post('/products', 'App\Http\Controllers\ProductController@store')->name('products.store');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('products.show');
Route::get('/products/{product}/edit', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::put('/products/{product}', 'App\Http\Controllers\ProductController@updateProduct')->name('products.update');
Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');

Route::get('/get-sizes/{category}','App\Http\Controllers\CategoryController@getSizesByCategory');
Route::get('/get-products','App\Http\Controllers\ProductStockController@getProducts');
Route::get('/get-sizes','App\Http\Controllers\ProductStockController@getSizes');

Route::get('/stock',  'App\Http\Controllers\ProductStockController@create');
Route::get('/products/{product}/stock', 'App\Http\Controllers\ProductStockController@edit')->name('stock.edit');
Route::put('/products/{product}/stock', 'App\Http\Controllers\ProductStockController@updateStock')->name('stock.update');
Route::post('/stock', 'App\Http\Controllers\ProductStockController@store');
});

//Client Routes
Route::middleware(['auth', 'client'])->group(function () {
    // Client-only routes here...
});



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

Auth::routes();
// routes/web.php
Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@logout')->name('logout');
Route::get('/shop','App\Http\Controllers\Shop\MainController@index')->name('shop.index');
Route::get('/shop/category/{category}', 'App\Http\Controllers\Shop\MainController@filterByCategory')->name('shop.filter.category');
Route::get('/shop/marques/{brand}', 'App\Http\Controllers\Shop\MainController@filterByBrand')->name('shop.filter.brand');
Route::get('/shop/{product}','App\Http\Controllers\Shop\MainController@show')->name('shop.show');
Route::get('/shop/products/{product}/colors/{color}/sizes', 'App\Http\Controllers\Shop\MainController@getAvailableSizes')->name('products.colors.sizes');



Route::get('/shopping-cart', 'App\Http\Controllers\Shop\MainController@productsCart')->name('shopping.cart');
Route::post('/cart/product/add/{product}', 'App\Http\Controllers\Shop\MainController@addToCart')->name('add.to.cart');
Route::patch('/update-shopping-cart', 'App\Http\Controllers\Shop\MainController@updateCart')->name('update.cart');
Route::delete('/delete-cart-product', 'App\Http\Controllers\Shop\MainController@deleteCart')->name('delete.cart.product');

Route::get('/get-communes/{wilaya}', 'App\Http\Controllers\Shop\CheckoutController@getCommunes');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');


//Route::get('/get-communes/{wilaya}', 'App\Http\Controllers\Auth\RegisterController@getCommunes');
