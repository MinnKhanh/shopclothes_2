<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product');
    }
    public function create()
    {
        return view('admin.addproduct', ['type' => Type::get()->toArray()]);
    }
}
