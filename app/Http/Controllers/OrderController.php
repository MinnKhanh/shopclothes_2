<?php

namespace App\Http\Controllers;

use App\Enums\StatusOrderEnum;
use App\Http\Requests\OrderRequest;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;

class OrderController extends Controller
{
    public function CreateOrder(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $cart = Session::get('cart') ? Session::get('cart') : null;
            if ($cart != null) {
                $order = Orders::create([
                    'id_customer' => 1,
                    'price' => $cart->getTotalMoney(),
                    'quantity' => $cart->getTotalQuantity(),
                    'type' => 1,
                    'payment_method' => $request->input('payment'),
                    'note' => $request->input('payment') ? $request->input('payment') : '',
                    'address' => $request->input('address'),
                    'discount' => $request->input('discount') ? $request->input('discount') : 0,
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                    'district' => $request->input('district'),
                    'zip_code' => $request->input('zip_code') ? $request->input('zip_code') : '',
                    'status' => StatusOrderEnum::Processing
                ]);
                foreach ($cart->getProductInCart() as $item) {
                    $productsize = ProductSize::where('size', $item['productInfo']['idsize'])->where('id_productdetail', $item['productInfo']['idProductDetail'])->first();

                    ProductSize::where('size', $item['productInfo']['idsize'])->where('id_productdetail', $item['productInfo']['idProductDetail'])->update([
                        'quantity' => $productsize->quantity - $item['quantity']
                    ]);
                    OrderDetails::create([
                        'id_order' => $order->id,
                        'id_product' => $item['productInfo']['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['productInfo']['price'],
                        'color' => $item['productInfo']['id_color'],
                        'size' => $item['productInfo']['idsize'],
                        'totalPrice' => $item['price']
                    ]);
                }
                DB::commit();
                $request->session()->forget('cart');
            } else {
                return Redirect::route('product.index');
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
