<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Color;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // dd(Type::get()->toArray());
        $product = Products::join('product_detail', 'products.id', '=', 'product_detail.id_product')
            ->select('products.id', 'products.name', 'products.category', 'products.type');
        $type = Type::leftjoinSub($product, 'product', function ($join) {
            $join->on('type.id', '=', 'product.type');
        })
            ->groupBy('type.id', 'type.name')
            ->select('type.id', 'type.name', DB::raw('count(product.id) as soluong'))
            ->get()->toArray();
        $categories = Categories::leftjoinSub($product, 'product', function ($join) {
            $join->on('categories.id', '=', 'product.category');
        })->join('type', 'type.id', '=', 'categories.type')
            ->groupBy('categories.id', 'categories.name', 'type.id', 'type.name')
            ->select('categories.id', 'categories.name', DB::raw('type.id as typeid'), DB::raw('type.name as typename'), DB::raw('count(product.id) as soluong'))
            ->get()->toArray();
        return view(
            'products.index',
            [
                'list' => Products::with('Img', 'BrandProduct')->get()->toArray(),
                'categories' => $categories,
                'type' => $type
            ]
        );
    }
    public function getProductBy(Request $request)
    {
        $product = Products::with('Img', 'BrandProduct');
        if ($request->input('type')) {
            $types = explode('-', $request->input('type'));
            $product->whereIn('type', $types);
        }
        if ($request->input('category')) {
            $categories = explode('-', $request->input('category'));
            $product->whereIn('category', $categories);
        }
        dd($product->get()->toArray());
    }
}
