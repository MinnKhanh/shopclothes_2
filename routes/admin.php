<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
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
});
Route::group([
    'as'     => 'type.',
    'prefix' => 'type',
], static function () {
    Route::get('/', [TypeController::class, 'index'])->name('index');
    Route::get('/create', [TypeController::class, 'create'])->name('create');
    Route::post('/store', [TypeController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'category.',
    'prefix' => 'category',
], static function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'brand.',
    'prefix' => 'brand',
], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [BrandController::class, 'store'])->name('store');
});
Route::group([
    'as'     => 'color.',
    'prefix' => 'color',
], static function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [ColorController::class, 'store'])->name('store');
});
