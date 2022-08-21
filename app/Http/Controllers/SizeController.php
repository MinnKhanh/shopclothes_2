<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function getListSize(Request $request)
    {

        $data = [];
        if ($request->input('q')) {
            $data = Size::where('name', 'like', '%' . $request->get('q') . '%')->where('type', $request->input('type'))->get()->toArray();
        } else {
            $data = Size::where('type', $request->input('type'))->get()->toArray();
        }
        return $data;
    }
}
