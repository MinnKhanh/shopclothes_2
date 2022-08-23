<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoiesRequest;
use App\Models\Categories;
use App\Models\Img;
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
    public function index()
    {
    }
    public function create()
    {
    }
    public function store(CategoiesRequest $request)
    {
        $Category = new Categories();
        $Category->name = $request->input('name');
        $Category->type = $request->input('type');
        $Category->save();
        $logo = optional($request->file('photo'))->store('public/categories_img');
        Img::create([
            'id_product' => $Category->id,
            'path' => $logo,
            'type' => 4,
            'img_index' => 1
        ]);
        return $Category;
    }
}
