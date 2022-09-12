<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function index(Request $request)
    {
        $customers = User::with('Img')->get()->toArray();
        return view('admin.customers.index', ['typenav' => $this->typenav, 'customers' => $customers]);
    }
}
