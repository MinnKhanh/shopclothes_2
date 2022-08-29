<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'color' => 'required',
            'quantity' => 'required| numeric|min:0',
            'size' => 'required',
        ]);
        if ($request->input('id') && $request->input('color') && $request->input('size')) {
            if ($request->input('quantity') >= 0) {
                $product = Products::join('product_detail', 'products.id', 'product_detail.id_product')
                    ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
                    ->join('color', 'color.id', 'product_detail.id_color')
                    ->where('products.id', $request->input('id'))
                    ->join('size', 'size.id', 'product_size.size')
                    ->where('product_detail.id_color', $request->input('color'))->where('product_size.size', $request->input('size'))
                    ->select(
                        'products.name',
                        'products.id',
                        DB::raw(
                            'products.priceSell as price'
                        ),
                        DB::raw('products.code'),
                        DB::raw('product_detail.id_color'),
                        DB::raw('color.name as namecolor'),
                        DB::raw('product_size.quantity'),
                        DB::raw('product_size.size as idsize'),
                        DB::raw('product_detail.id as idProductDetail'),
                        DB::raw('size.name as namesize'),
                    )->first()->toArray();
                if ($product != null) {
                    $oldcart = Session('cart') ? Session('cart') : null;
                    $newcart = new Cart($oldcart);
                    $newcart->AddCart($product, $product['idProductDetail'], $request->input('quantity'),);
                    $request->session()->put('cart', $newcart);
                }
            }
            return [$request->session()->get('cart')];
        }
    }
    public function removeProductInCart(Request $request)
    {
        $request->validate([
            'idProduct' => 'required',
            'size' => 'required',
        ]);
        $oldcart = Session('cart') ? Session('cart') : null;
        $newcart = new Cart($oldcart);
        $newcart->removeProductInCart($request->input('idProduct'), $request->input('size'));
        if ($newcart->getTotalQuantity() <= 0) {
            $request->session()->forget('cart');
            return [];
        } else
            $request->session()->put('cart', $newcart);
        return [$request->session()->get('cart')];
    }
    public function changeCart(Request $request)
    {
        $request->validate([
            'idProduct' => 'required',
            'quantity' => 'required| numeric',
            'size' => 'required',
        ]);
        $product = ProductDetail::where('id', $request->input('idProduct'))->first();
        if ($product != null) {
            $oldcart = Session('cart') ? Session('cart') : null;
            if ($oldcart != null) {
                $newcart = new Cart($oldcart);
                $newcart->changeQuantityProduct($request->input('idProduct'), $request->input('quantity'), $request->input('size'));
                $request->session()->put('cart', $newcart);
            }
            return [$request->session()->get('cart')];
        }
    }
    public function removeCart(Request $request)
    {
        $oldcart = Session('cart') ? Session('cart') : null;
        if ($oldcart != null) {
            $newcart = new Cart($oldcart);
            $newcart->removeCart();
        }
        $request->session()->forget('cart');
    }
}
