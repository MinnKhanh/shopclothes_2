<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
        parent::__construct();
    }
    public function index(Request $request)
    {
        $customers = User::with('Img')->get()->toArray();
        return view('admin.customers.index', ['typenav' => $this->typenav, 'customers' => $customers]);
    }
    public function deletecustomer(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $order = Orders::where('id_customer', $request->input('id'));
            OrderDetails::whereIn('id_order', $order->select('id')->get()->toArray())->delete();
            $order->delete();
            User::where('id', $request->input('id'))->delete();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['eror' => "Xóa thất bại"], 400);
        }
    }
}
