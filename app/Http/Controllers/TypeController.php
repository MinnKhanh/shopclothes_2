<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Img;
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
    public function create(Request $request)
    {
    }
    public function store(Request $request)
    {
        $type = new Type();
        $type->name = $request->input('name');
        $type->save();
        $logo = optional($request->file('photo'))->store('public/type_img');
        $logo = str_replace("public/", "", $logo);
        Img::create([
            'id_product' => $type->id,
            'path' => $logo,
            'type' => 3,
            'img_index' => 1
        ]);
        return $type;
    }
}
