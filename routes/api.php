<?php

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TypeController;
use App\Models\Color;
use App\Models\ProductDetail;
use App\Models\Products;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'getListCategories'])->name('categories');
Route::get('/type', [TypeController::class, 'getListType'])->name('type');
Route::get('/brand', [BrandController::class, 'getListBrand'])->name('brand');
Route::get('/color', [ColorController::class, 'getListColor'])->name('color');
Route::get('/size', [SizeController::class, 'getListSize'])->name('size');
Route::get('/productdetail', [ProductController::class, 'getDetailProduct'])->name('productdetail');
Route::get('/list-name-product', [ControllersProductController::class, 'listNameProduct'])->name('listnameproduct');
