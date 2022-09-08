<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Img;
use App\Models\ProductDetail;
use App\Models\Products;
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [MainController::class, 'index'])->name('index');

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
Route::group([
    'as'     => 'product.',
    'prefix' => 'product',
], static function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/list-product', [ProductController::class, 'getProductBy'])->name('listproduct');
    Route::get('/product-detail', [ProductController::class, 'getProductDetail'])->name('productdetail');
    Route::get('/getsizeandimg', [ProductController::class, 'getSizeAndImg'])->name('getsizeandimg');
});
Route::group([
    'as'     => 'cart.',
    'prefix' => 'cart',
], static function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/addtocart', [CartController::class, 'AddToCart'])->name('addtocart');
    Route::get('/removecart', [CartController::class, 'removeCart'])->name('removecart');
    Route::get('/changecart', [CartController::class, 'changeCart'])->name('changecart');
    Route::get('/removeproductincart', [CartController::class, 'removeProductInCart'])->name('removeproductincart');
    Route::get('/getdiscount', [CartController::class, 'getDiscount'])->name('getdiscount');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
    Route::post('/checkout', [OrderController::class, 'CreateOrder'])->name('checkout');
});
Route::group([
    'as'     => 'orders.',
    'prefix' => 'orders',
], static function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/detail', [OrderController::class, 'OrderDetail'])->name('detail');
    Route::delete('/delete', [OrderController::class, 'delete'])->name('delete');
    Route::get('/updateinfor/{id}', [OrderController::class, 'updateInfor'])->name('updateinfor');
    Route::delete('/deletedetail', [OrderController::class, 'deleteDetail'])->name('deletedetail');
    Route::post('/update-order', [OrderController::class, 'updateOrder'])->name('updateorder');
    Route::get('/reject', [OrderController::class, 'rejectUpdate'])->name('reject');
});
Route::group([
    'as'     => 'auth.',
    'prefix' => 'auth',
], static function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registering', [AuthController::class, 'registering'])->name('registering');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
});
