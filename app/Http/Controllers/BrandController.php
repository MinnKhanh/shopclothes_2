<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Img;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        //dd(Brand::with('Img')->get()->toArray());
    }
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->country = $request->input('country');
        $brand->description = $request->input('description');
        $brand->save();
        $logo = optional($request->file('photo'))->store('public/brand_img');
        Img::create([
            'id_product' => $brand->id,
            'path' => $logo,
            'type' => 5,
            'img_index' => 1
        ]);
        return $brand;
    }
    public function getListBrand(Request $request)
    {

        $data = [];
        if ($request->input('q')) {
            $data = Brand::where('name', 'like', '%' . $request->get('q') . '%')->get()->toArray();
        } else {
            $data = Brand::get()->toArray();
        }
        return $data;
    }
}
