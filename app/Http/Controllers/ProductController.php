<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Color;
use App\Models\ProductDetail;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        if ($request->input('price')) {
            $prices = preg_replace("/[Đ\.><]/", "", $request->input('price'));
            // $prices = str_replace(".", "", $prices);
            // $prices = str_replace(".", "", $prices);
            $prices = explode('_', $prices);
            $product->where(function ($query) use ($prices) {
                foreach ($prices as $item) {
                    $itemprices = explode(' ', trim($item));
                    $from = $itemprices[0];
                    $to = $itemprices[count($itemprices) - 1];
                    $query->orwhereBetween('priceSell', [$from, $to]);
                }
            });
        }
        if ($request->input('search')) {
            $product->where('name', 'like', '%' . $request->get('search') . '%');
        }
        //  dd($product->get()->toArray());
        return $product->get()->toArray();
    }
    public function getProductDetail(Request $request)
    {
        $data = ProductDetail::with(['colorProduct', 'Img' => fn ($query) => $query->where('type', 2)->where('img_index', 1)])->where('id_product', $request->input('id'))->get()->toArray();
        $product = Products::with('Img')->where('id', $request->input('id'))->first()->toArray();
        $dataSuggest = Products::with('Img')->where('type', $product['type'])->where('category', $product['category'])->where('id', '!=', $product['id'])->get()->toArray();
        return view('products.detail', [
            'data' => $data,
            'product' => $product,
            'productSuggest' => $dataSuggest
        ]);
    }
    public function listNameProduct(Request $request)
    {
        $data = Products::pluck('name')->toArray();
        return $data;
    }
    public function getSizeAndImg(Request $request)
    {
        if ($request->input('id') && $request->input('color')) {
            $listsize = ProductDetail::where('product_detail.id_product', $request->input('id'))->where('product_detail.id_color', $request->input('color'))
                ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
                ->join('size', 'size.id', 'product_size.size')->select(DB::raw('product_detail.id as idProduct'), 'size.name', 'size.id', 'product_size.quantity')->get()->toArray();
            //  DB::enableQueryLog();
            $listImg = ProductDetail::join('imgs', 'imgs.product_id', 'product_detail.id')->where('imgs.type', 2)->where('imgs.deleted_at', null)
                ->where('product_detail.id_product', $request->input('id'))->where('product_detail.id_color', $request->input('color'))->get('imgs.path')->toArray();
            //dd($listImg);
            // dd(DB::getQueryLog());
            return [$listsize, $listImg, Session::get('cart') ? Session::get('cart') : []];
        }
    }
}
