<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Img;
use App\Models\ProductDetail;
use App\Models\Products;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;
use Throwable;

class ProductController extends Controller
{
    use ResponseTrait;
    public function index()
    {

        return view('admin.product');
    }
    public function create()
    {
        // DB::enableQueryLog();
        // dd(Type::with(['Categories' => fn ($query) => $query->where('id', 1)])->where('id', 1)->get()->first()->toArray()['categories'][0]['name']);
        // dd(DB::getQueryLog());
        return view('admin.addproduct', ['type' => Type::query(), 'brand' => Brand::query()]);
    }
    public function update(Request $request)
    {
        //dd(Products::with('Img', 'BrandProduct', 'TypeProduct')->where('id', $request->get('id'))->first()->toArray());
        return view('admin.addproduct', [
            'type' => Type::query(), 'brand' => Brand::query(),
            'edit' => 1, 'product' => Products::with('Img')->where('id', $request->get('id'))->first()->toArray()
        ]);
    }
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {

            $product = new Products();
            if ($request->get('id')) {
                $product = Products::where('id', $request->get('id'))->first();
            }
            $product->name = $request->get('name');
            $product->code = $request->get('code');
            $product->category = $request->get('category');
            $product->priceImport = $request->get('priceImport');
            $product->priceSell = $request->get('priceSell');
            $product->type = $request->get('type');
            $product->brand = $request->get('brand');
            $product->status = $request->get('status');
            $product->feated = $request->get('featured');
            $product->description = $request->get('description');
            $product->quantity = $request->get('quantity') ? $request->get('quantity') : 0;
            $product->save();
            if ($request->file('photo')) {
                $logo = optional($request->file('photo'))->store('public/product_img');
                if ($request->get('id')) {
                    DB::table('imgs')->where("product_id", $request->get('id'))->where('type', 1)->update(['path' => $logo]);
                    DB::commit();
                    return redirect()->route('admin.product.index');
                } else {
                    Img::create([
                        'product_id' => $product->id,
                        'path' => $logo,
                        'type' => 1
                    ]);
                    DB::commit();
                    return redirect()->route('admin.product.createdetail', ['id' => $product->id]);
                }
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => 'Thêm Thất Bại']);
        }
    }
    public function createDetail(Request $request)
    {
        //dd(Color::pluck('id')->toArray());
        return view('admin.category', ['id' => $request->get('id')]);
    }
    public function storeDetail(Request $request)
    {
        $request->validate([
            'idProduct' => 'required',
            'color' => ['required', Rule::in(Color::pluck('id')->toArray()),],
            'size' => ['required', Rule::in(Size::pluck('id')->toArray()),],
            'quanity' => 'required| numeric',
            'photo' => 'required',
            'photo.*' => 'mimes:csv,txt,xlx,xls,pdf'
        ]);
        $productDetail = new ProductDetail();
        $productDetail->size = $request->input('size');
        $productDetail->color = $request->input('color');
        $productDetail->quanity = $request->input('quanity');
        $productDetail->id_product = $request->input('idProduct');
        $productDetail->save();
        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            foreach ($files as $file) {
                $logo = optional($file)->store('product-detail_img');
                Img::create([
                    'product_id' => $productDetail->id,
                    'path' => $logo,
                    'type' => 2
                ]);
            }
        }
        return $productDetail;
    }
}
