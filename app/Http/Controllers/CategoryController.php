<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getListCategories(Request $request)
    {
        $data = [];
        if ($request->input('type')) {
            $data = Categories::where('type', $request->input('type'));
            if ($request->input('q')) {
                $data->where('name', 'like', '%' . $request->get('q') . '%');
            }
            $data = $data->get()->toArray();
        }
        return $data;
    }
}
