<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getListType(Request $request)
    {
        $data = [];
        if ($request->input('q')) {
            $data = Type::where('name', 'like', '%' . $request->get('q') . '%')->get()->toArray();
        } else {
            $data = Type::get()->toArray();
        }
        return $data;
    }
}
