<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    $productsize = ProductDetail::with(['sizeProduct', 'colorProduct', 'ProductSizeDetail' => function ($query) {
        $query->select('id_productdetail', DB::raw('sum(quantity) as sum'))->groupBy('id_productdetail');
    }])->where('id_product', 5)->get()->toArray();
    dd($productsize);
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
Route::group([
    'as'     => 'product.',
    'prefix' => 'product',
], static function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/list-product', [ProductController::class, 'getProductBy'])->name('listproduct');
    Route::get('/product-detail', [ProductController::class, 'getProductDetail'])->name('productdetail');
});
