<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        $color = Color::create([
            'name' => $request->get('name')
        ]);
        return $color;
    }
    public function getListColor(Request $request)
    {
        $data = [];
        if ($request->input('q')) {
            $data = Color::where('name', 'like', '%' . $request->get('q') . '%')->get()->toArray();
        } else {
            $data = Color::get()->toArray();
        }
        return $data;
    }
}
