<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    public function index(Request $request)
    {
        return view('test.index');
    }
    public function put(Request $request)
    {
        dd('chay');
    }
}
