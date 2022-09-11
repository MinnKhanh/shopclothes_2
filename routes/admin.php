<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\TypeController;
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
