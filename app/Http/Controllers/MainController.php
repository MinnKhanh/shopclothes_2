<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Discount;
use App\Models\Introduce;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    public function __construct()
    {
        // View::share('numerberOfcart',Session('cart') ? Session('cart')->getTotalQuantity() : 0);
        parent::__construct();
    }
    public function index(Request $request)
    {
        $type = Type::with('Img', 'Categories')->withCount('Product')->get()->toArray();
        $brand = Brand::with('Img')->get()->toArray();
        $products = Products::with('Img')
            ->join('product_detail', 'product_detail.id_product', 'products.id')
            ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
            ->orderBy('products.created_at', 'DESC')
            ->groupBy('products.id', 'products.name', 'products.priceSell')
            ->select('products.id', 'products.name', 'products.priceSell', DB::raw('sum(product_size.quantity) as quantity'))
            ->offset(0)->limit(8)->get()->toArray();
        $productfeatured = Products::with('Img')
            ->join('product_detail', 'product_detail.id_product', 'products.id')
            ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
            ->orderBy('products.created_at', 'DESC')
            ->groupBy('products.id', 'products.name', 'products.priceSell')
            ->join('rate', 'rate.id_product', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.priceSell',
                DB::raw('sum(product_size.quantity) as quantity'),
                DB::raw('(sum(rate.number_stars)/count(rate.id_product)) as number')
            ) //->offset(0)->limit(8)->get()->toArray()
            // ->filter(function ($item, $key) {
            //     return $item->number < 4;
            // });
            ->havingRaw('(sum(rate.number_stars)/count(rate.id_product)) >= 3')
            ->offset(0)->limit(8)->get()->toArray();
        // $pp = DB::table('products')->get()
        //     ->filter(function ($item, $key) {
        //         return $item->id < 6;
        //     });
        // dd($pp);
        $introduce = Introduce::with('Img')->where('active', 2)->where('type', 2)->get()->toArray();
        $discountshow = Introduce::with('Img')->join('discount', 'discount.id', 'introduces.relate_id')->where('introduces.active', 2)->where('introduces.type', 1)->orderBy('discount.created_at', 'DESC')->select(DB::raw('introduces.*'), DB::raw('discount.persent as persent'),  DB::raw('discount.created_at as date'), DB::raw('discount.unit as unit'))->offset(0)->limit(2)->get()->toArray();
        //dd($discountshow);
        return view('index', ['typenav' => $type, 'product' => $products, 'brand' => $brand, 'productfeatured' => $productfeatured, 'introduce' => $introduce, 'discountshow' => $discountshow]);
    }
}
