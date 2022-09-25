<?php

namespace App\Http\Controllers;

use App\Enums\OrderTypeEnum;
use App\Enums\StatusOrderEnum;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderUpdate;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\Type;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function CreateOrder(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $cart = Session::get('cart') ? Session::get('cart') : null;
            if ($cart != null) {
                $order = Orders::create([
                    'id_customer' => auth()->user()->id,
                    'price' => $cart->getTotalMoney(),
                    'quantity' => $cart->getTotalQuantity(),
                    'type' => OrderTypeEnum::OrderSell,
                    'payment_method' => $request->input('payment'),
                    'note' => $request->input('note') ? $request->input('note') : '',
                    'address' => $request->input('address'),
                    'discount' => $request->input('discount') ? $request->input('discount') : 0,
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                    'district' => $request->input('district'),
                    'zip_code' => $request->input('zip_code') ? $request->input('zip_code') : '',
                    'status' => StatusOrderEnum::Processing,
                    'ship' => $request->input('ship')
                ]);
                foreach ($cart->getProductInCart() as $item) {
                    $productsize = ProductSize::where('size', $item['productInfo']['idsize'])->where('id_productdetail', $item['productInfo']['idProductDetail'])->first();

                    ProductSize::where('size', $item['productInfo']['idsize'])->where('id_productdetail', $item['productInfo']['idProductDetail'])->update([
                        'quantity' => $productsize->quantity - $item['quantity']
                    ]);
                    OrderDetails::create([
                        'id_order' => $order->id,
                        'id_product' => $item['productInfo']['idProductDetail'],
                        'quantity' => $item['quantity'],
                        'price' => $item['productInfo']['price'],
                        // 'color' => $item['productInfo']['id_color'],
                        'size' => $item['productInfo']['idsize'],
                        'totalPrice' => $item['price']
                    ]);
                }
                DB::commit();
                $request->session()->forget('cart');
                return Redirect::route('product.index');
            } else {
                return Redirect::route('product.index');
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
    public function index(Request $request)
    {
        $orders = Orders::where('id_customer', $request->input('id'))->where('type', OrderTypeEnum::OrderSell)->get()->toArray();
        return view('orders.listorder', ['orders' => $orders, 'typenav' => $this->typenav]);
    }
    public function OrderDetail(Request $request)
    {
        if ($request->input('id')) {
            $data = OrderDetails::where('id_order', $request->input('id'))
                ->join('product_detail', 'product_detail.id', 'order_details.id_product')
                ->join('product_size', function ($join) {
                    $join->on('product_size.id_productdetail', '=', 'product_detail.id');
                    $join->on('order_details.size', '=', 'product_size.size');
                })
                ->join('products', 'products.id', 'product_detail.id_product')
                ->join('color', 'color.id', 'product_detail.id_color')
                ->join('size', 'size.id', 'product_size.size')
                ->join('imgs', 'imgs.product_id', 'product_detail.id')->where('img_index', 1)
                ->select('order_details.quantity', 'order_details.totalPrice', 'order_details.size', 'products.name', 'imgs.path', DB::raw('color.name as colorname'), DB::raw('size.name as sizename'))->get()->toArray();
            return $data;
        }
        return [];
    }
    public function delete(Request $request)
    {
        if ($request->input('id')) {
            try {
                DB::beginTransaction();
                $data = OrderDetails::where('id_order', $request->input('id'))->get()->toArray();
                foreach ($data as $item) {
                    $productsize = ProductSize::where('size', $item['size'])->where('id_productdetail', $item['id_product'])->first();

                    ProductSize::where('size', $item['size'])->where('id_productdetail', $item['id_product'])->update([
                        'quantity' => $productsize->quantity + $item['quantity']
                    ]);
                }
                OrderDetails::where('id_order', $request->input('id'))->delete();
                Orders::where('id', $request->input('id'))->delete();
                DB::commit();
                return response()->json(['error' => 'Xóa thành công'], 200);
            } catch (Throwable $e) {
                DB::rollBack();
                return response()->json(['error' => 'Xóa thất bại'], 404);
            }
        }
    }
    public function updateInfor($id, Request $request)
    {
        if ($id) {
            $order = Orders::where('id', $id)->with('DiscountProduct')->first();
            //  dd($order);
            $orderdetail = OrderDetails::where('id_order', $id)
                ->join('product_detail', 'product_detail.id', 'order_details.id_product')
                ->join('product_size', function ($join) {
                    $join->on('product_size.id_productdetail', '=', 'product_detail.id');
                    $join->on('order_details.size', '=', 'product_size.size');
                })
                ->join('products', 'products.id', 'product_detail.id_product')
                ->join('color', 'color.id', 'product_detail.id_color')
                ->join('size', 'size.id', 'product_size.size')
                ->join('imgs', 'imgs.product_id', 'product_detail.id')->where('img_index', 1)
                ->select('order_details.quantity', 'order_details.id_order', 'order_details.id_product', 'order_details.totalPrice', 'order_details.size', 'products.name', 'imgs.path', DB::raw('color.name as colorname'), DB::raw('size.name as sizename'))->get()->toArray();
            return view('orders.updateorder', ['order' => $order, 'orderdetail' => $orderdetail, 'id' => $id, 'typenav' => $this->typenav]);
        }
    }
    public function deleteDetail(Request $request)
    {
        if ($request->input('order') && $request->input('product') && $request->input('size')) {
            try {
                DB::beginTransaction();
                $orderdetail = OrderDetails::where('id_order', $request->input('order'))->where('id_product', $request->input('product'))->where('size', $request->input('size'))->first();
                $productsize = ProductSize::where('size', $request->input('size'))->where('id_productdetail', $request->input('product'))->first();
                //dd($productsize->quantity);
                ProductSize::where('size', $request->input('size'))->where('id_productdetail', $request->input('product'))->update([
                    'quantity' => $productsize->quantity + $orderdetail->quantity
                ]);
                $order = Orders::where('id', $request->input('order'))->first();
                $order->quantity = $order->quantity - $orderdetail->quantity;
                $order->price = $order->price - $orderdetail->totalPrice;
                $order->save();
                OrderDetails::where('id_order', $request->input('order'))->where('id_product', $request->input('product'))->where('size', $request->input('size'))->delete();
                DB::commit();
                return [$order->price, $order->quantity];
            } catch (Throwable $e) {
                DB::rollBack();
                return response()->json(['error' => 'Xóa thất bại'], 404);
            }
        }
    }
    public function updateOrder(OrderUpdate $request)
    {
        try {
            DB::beginTransaction();
            Orders::where('id', $request->input('id'))->update([
                'note' => $request->input('note') ? $request->input('note') : '',
                'address' => $request->input('address'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'zip_code' => $request->input('zip_code') ? $request->input('zip_code') : '',
                'ship' => $request->input('ship')
            ]);
            DB::commit();
            return Redirect::route('orders.index');
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => 'Cập nhật thất bại vui lòng thử lại']);
        }
    }
    public function rejectUpdate(Request $request)
    {
        return redirect()->route('orders.index');
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $order = Orders::where('id', $request->input('id'))->first();
            if ($order) {
                $order->update([
                    'status' => $request->input('status')
                ]);
                DB::commit();
            }
            return response()->json(['success' => 'Thay đổi thanh công'], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Xóa thất bại'], 404);
        }
    }
}
