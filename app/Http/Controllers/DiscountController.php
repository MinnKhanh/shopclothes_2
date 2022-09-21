<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Type;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function index(Request $request)
    {
        $discount = Discount::get()->toArray();
        return view('admin.discount.index', ['discount' => $discount, 'typenav' => $this->typenav]);
    }
}
