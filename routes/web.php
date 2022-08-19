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

Route::get('/', function () {
    return view('index');
});
Route::get('products', function () {
    return view('products.index');
});
Route::get('products/detail', function () {
    return view('products.detail');
});
Route::get('customer/contact', function () {
    return view('auth.register');
});
Route::get('orders/cart', function () {
    return view('orders.cart');
});
Route::get('orders/checkout', function () {
    return view('orders.checkout');
});
