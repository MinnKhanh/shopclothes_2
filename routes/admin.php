<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\CustomizeController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderImportController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\TypeController;
use App\Models\Orders;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'as'     => 'product.',
    'prefix' => 'product',
], static function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/update', [ProductController::class, 'update'])->name('update');
    Route::get('/create-detail', [ProductController::class, 'createDetail'])->name('createdetail');
    Route::post('/store-detail', [ProductController::class, 'storeDetail'])->name('storedetail');
    Route::delete('/remove-img', [ProductController::class, 'removeImg'])->name('removeimg');
    Route::delete('/remove-detail', [ProductController::class, 'removeDetail'])->name('removedetail');
    Route::post('/store-size', [ProductController::class, 'storeSize'])->name('storeSize');
    Route::get('/getsize', [ProductController::class, 'getSize'])->name('getsize');
    Route::delete('/removesize', [ProductController::class, 'removeSize'])->name('removesize');
    Route::post('/changesize', [ProductController::class, 'changeSize'])->name('changesize');
    Route::get('/changstatus', [ProductController::class, 'changStatus'])->name('changstatus');
    Route::post('/delete', [ProductController::class, 'delete'])->name('delete');
});
Route::group([
    'as'     => 'type.',
    'prefix' => 'type',
], static function () {
    Route::get('/', [TypeController::class, 'index'])->name('index');
    Route::get('/create', [TypeController::class, 'create'])->name('create');
    Route::post('/store', [TypeController::class, 'store'])->name('store');
    Route::get('/update', [TypeController::class, 'update'])->name('update');
    Route::delete('/delete', [TypeController::class, 'delete'])->name('delete');
});
Route::group([
    'as'     => 'category.',
    'prefix' => 'category',
], static function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/listcategories', [CategoryController::class, 'getCategoriesById'])->name('listbyid');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::delete('/delete', [CategoryController::class, 'delete'])->name('delete');
    Route::post('/update', [CategoryController::class, 'update'])->name('update');
});
Route::group([
    'as'     => 'brand.',
    'prefix' => 'brand',
], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::get('/update', [BrandController::class, 'update'])->name('update');
    Route::post('/store', [BrandController::class, 'store'])->name('store');
    Route::delete('/delete', [BrandController::class, 'delete'])->name('delete');
});
Route::group([
    'as'     => 'color.',
    'prefix' => 'color',
], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [ColorController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'order.',
    'prefix' => 'order',
], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [ColorController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'customers.',
    'prefix' => 'customers',
], static function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::post('/deleteCustomer', [CustomerController::class, 'deletecustomer'])->name('deletecustomer');
});
Route::group([
    'as'     => 'customize.',
    'prefix' => 'customize',
], static function () {
    Route::get('/banner', [CustomizeController::class, 'banner'])->name('banner');
    Route::get('/edit', [CustomizeController::class, 'edit'])->name('edit');
});
Route::group([
    'as'     => 'statistical.',
    'prefix' => 'statistical',
], static function () {
    Route::get('/', [StatisticalController::class, 'index'])->name('index');
    Route::get('/product-categories', [StatisticalController::class, 'productCategories'])->name('productcategories');
    Route::get('/byproduct', [StatisticalController::class, 'byProduct'])->name('byproduct');
    Route::get('/bycustomer', [StatisticalController::class, 'byCustomer'])->name('bycustomer');
    Route::get('/bycategories', [StatisticalController::class, 'byCategories'])->name('bycategories');
});
Route::group([
    'as'     => 'discount.',
    'prefix' => 'discount',
], static function () {
    Route::get('/', [DiscountController::class, 'index'])->name('index');
    Route::delete('/delete', [DiscountController::class, 'delete'])->name('delete');
    Route::get('/edit', [DiscountController::class, 'edit'])->name('edit');
    Route::get('/create', [DiscountController::class, 'create'])->name('create');
    Route::post('/store', [DiscountController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'orderimport.',
    'prefix' => 'orderimport',
], static function () {
    Route::get('/', [OrderImportController::class, 'index'])->name('index'); //->middleware('checkapplicant');
    Route::get('/create', [OrderImportController::class, 'create'])->name('create'); //->middleware('checkapplicant');
    Route::get('/store', [OrderImportController::class, 'store'])->name('store');
    Route::get('/addtocart', [OrderImportController::class, 'AddToCart'])->name('addtocart');
    Route::delete('/removeproductincart', [OrderImportController::class, 'removeProductInCart'])->name('removeproductincart');
    Route::get('/changequantity', [OrderImportController::class, 'changeCart'])->name('changequantity');
    Route::get('/checkcart', [OrderImportController::class, 'checkCart'])->name('checkcart');
    Route::get('/checkout', [OrderImportController::class, 'checkOut'])->name('checkout');
    Route::post('/create-order', [OrderImportController::class, 'CreateOrder'])->name('createorder');
    Route::get('/orderdetail', [OrderImportController::class, 'orderDetail'])->name('orderdetail');
    Route::delete('/delete', [OrderImportController::class, 'delete'])->name('delete');
});

Route::get('/', function () {
    $typenav = Type::with('Img', 'Categories')->withCount('Product')
        ->get()->toArray();
    return view('admin.index', ['typenav' => $typenav]);
});
