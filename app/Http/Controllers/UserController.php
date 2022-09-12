<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function index(Request $request)
    {
        if (auth()->check()) {
            // dd(auth()->user());
            return view('customer.userinfo', ['typenav' => $this->typenav]);
        }
    }
    public function updateInfo(Request $request)
    {
        User::where('id', auth()->user()->id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
        ]);
    }
}
