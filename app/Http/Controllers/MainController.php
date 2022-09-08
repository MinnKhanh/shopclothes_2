<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $type = Type::with('Img')->withCount('Product')->get()->toArray();
        $brand = Brand::with('Img')->get()->toArray();
        $products = Products::with('Img')
            ->join('product_detail', 'product_detail.id_product', 'products.id')
            ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
            ->orderBy('products.created_at', 'DESC')
            ->groupBy('products.id', 'products.name', 'products.priceSell')
            ->select('products.id', 'products.name', 'products.priceSell', DB::raw('sum(product_size.quantity) as quantity'))
            ->offset(0)->limit(8)->get()->toArray();
        //dd($products);
        return view('index', ['categories' => $type, 'product' => $products, 'brand' => $brand]);
    }
}
