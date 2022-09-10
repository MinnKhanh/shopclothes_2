<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoiesRequest;
use App\Models\Categories;
use App\Models\Img;
use App\Models\Products;
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
        $logo = str_replace("public/", "", $logo);
        Img::create([
            'product_id' => $Category->id,
            'path' => $logo,
            'type' => 4,
            'img_index' => 1
        ]);
        return Categories::with('Img')->where('id', $Category->id)->first()->toArray();
    }
    public function getCategoriesById(Request $request)
    {
        if ($request->input('id')) {
            $data = Categories::with('Img')->where('type', $request->input('id'))->get()->toArray();
            return $data;
        }
    }
    public function delete(Request $request)
    {
        if ($request->input('id')) {
            if (Products::join('categories', 'categories.id', 'products.category')->where('categories.id', $request->input('id'))->count()) {
                return response()->json(['error' => 'Hiện còn sản phẩm trong kho thuộc loại này không thể xóa'], 400);
            } else {
                Categories::where('id', $request->input('id'))->delete();
                return response()->json(['success' => 'Xóa thành công'], 200);
            }
        }
    }
}
