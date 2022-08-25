<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
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
            $product->featured = $request->get('featured');
            $product->description = $request->get('description');
            $product->quantity = $request->get('quantity') ? $request->get('quantity') : 0;
            $product->save();
            if ($request->file('photo')) {
                $logo = optional($request->file('photo'))->store('public/product_img');
                $logo = str_replace("public/", "", $logo);
                if ($request->get('id')) {
                    DB::table('imgs')->where("product_id", $request->get('id'))->where('type', 1)->update(['path' => $logo]);
                    DB::commit();
                    return redirect()->route('admin.product.index');
                } else {
                    Img::create([
                        'product_id' => $product->id,
                        'path' => $logo,
                        'type' => 1,
                        'img_index' => 1
                    ]);
                    DB::commit();
                    return redirect()->route('admin.product.createdetail', ['id' => $product->id]);
                }
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
    public function createDetail(Request $request)
    {
        //dd(ProductDetail::with('sizeProduct', 'colorProduct')->where('id_product', $request->get('id'))->get()->toArray());
        return view('admin.category', [
            'id' => $request->get('id'),
            'list' => ProductDetail::with('sizeProduct', 'colorProduct')->where('id_product', $request->get('id'))->get()->toArray()
        ]);
    }
    public function storeDetail(Request $request)
    {
        $request->validate([
            'idProduct' => 'required',
            'color' => ['required', Rule::in(Color::pluck('id')->toArray()),],
            'size' => ['required', Rule::in(Size::pluck('id')->toArray()),],
            'quantity' => 'required| numeric',
            'photo' => $request->input('id') ? '' : 'required',
            'photo.*' => $request->input('id') ? '' : 'image',
            'numberimg' => $request->input('id') ? 'numeric' : ''
        ]);
        $productDetail = new ProductDetail();
        if ($request->input('id')) {
            $productDetail = ProductDetail::where('id', $request->input('id'))->first();
        }
        //$productDetail = new ProductDetail();
        $productDetail->id_size = $request->input('size');
        $productDetail->id_color = $request->input('color');
        $productDetail->quantity = $request->input('quantity');
        $productDetail->id_product = $request->input('idProduct');
        $productDetail->save();
        if ($request->input('id')) {
            for ($i = 1; $i <= $request->input('numberimg'); $i++) {
                //dd('chay');
                if ($request->hasFile('photo' . $i)) {
                    $logo = optional($request->file('photo' . $i))->store('public/product_img');
                    DB::table('imgs')->where("product_id", $request->get('id'))->where('type', 2)->where('img_index', $i)->update(['path' => $logo]);
                }
            }
            if ($request->hasFile('photo')) {

                $files = $request->file('photo');
                $i = $request->input('numberimg');
                foreach ($files as $file) {
                    $i++;
                    $logo = optional($file)->store('public/product-detail_img');
                    Img::create([
                        'product_id' => $productDetail->id,
                        'path' => $logo,
                        'type' => 2,
                        'img_index' => $i
                    ]);
                }
            }
        }
        // dd('khong cos');
        else if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            $i = 0;
            foreach ($files as $file) {
                $i++;
                $logo = optional($file)->store('public/product-detail_img');
                Img::create([
                    'product_id' => $productDetail->id,
                    'path' => $logo,
                    'type' => 2,
                    'img_index' => $i
                ]);
            }
        }
        return [$productDetail, Size::where('id', $request->input('size'))->first()->name, Color::where('id', $request->input('color'))->first()->name];
    }
    public function getDetailProduct(Request $request)
    {
        $data = ProductDetail::with(['Img' => fn ($query) => $query->where('type', 2), 'sizeProduct', 'colorProduct'])->where('id', $request->input('id'))->first();
        return $data ? $data->toArray() : [];
    }
    public function updateProductDetail(Request $request)
    {
    }
    public function removeImg(Request $request)
    {
        if ($request->input('id')) {
            Img::where('id', $request->input('id'))->delete();
            return 1;
        }
        return 0;
    }
    public function removeDetail(Request $request)
    {
        if ($request->input('id')) {
            ProductDetail::where('id', $request->input('id'))->delete();
            Img::where('product_id', $request->input('id'))->where('type', 2)->delete();
        }
    }
}
