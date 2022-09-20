<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class CustomizeController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function banner(Request $request)
    {
        return view('admin.customize.banner', ['typenav' => $this->typenav]);
    }
    public function edit(Request $request)
    {
        return view('admin.customize.edit', ['typenav' => $this->typenav]);
    }
}
