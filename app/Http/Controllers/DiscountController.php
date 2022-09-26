<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Img;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
            parent::__construct();
    }
    public function index(Request $request)
    {
        $discount = Discount::with('Img')->get()->toArray();
        return view('admin.discount.index', ['discount' => $discount, 'typenav' => $this->typenav]);
    }
    public function edit(Request $request)
    {
        return view('admin.discount.CreateOrUpdate', ['typenav' => $this->typenav, 'discount' => Discount::with('Img')->where('id', $request->input('id'))->first()->toArray(), 'isedit' => $request->input('id')]);
    }
    public function delete(Request $request)
    {
        try {
            Discount::where('id', $request->input('id'))->delete();
            return Redirect::route('admin.discount.index');
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
    public function create(Request $request)
    {
        return view('admin.discount.CreateOrUpdate', ['typenav' => $this->typenav]);
    }
    public function update(Request $request)
    {
        $discount = [];
        if ($request->input('id')) {
            $discount = Discount::where('id', $request->input('id'));
        }
        return view('admin.discount.CreateOrUpdate', ['isedit' => 1, 'id' => $request->input('id'), 'discount' => $discount, 'typenav' => $this->typenav]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $discount = new Discount();
            if ($request->input('id')) {
                $discount = Discount::where('id', $request->input('id'))->first();
            }
            $discount->persent = $request->input('persent');
            $discount->type = $request->input('type');
            $discount->begin = $request->input('begin');
            $discount->end = $request->input('end');
            $discount->name = $request->input('name');
            $discount->code = $request->input('code');
            $discount->discription = $request->input('description');
            $discount->unit = $request->input('unit');
            $discount->save();
            if ($request->file('photo')) {
                $logo = optional($request->file('photo'))->store('public/discount_img');
                $logo = str_replace("public/", "", $logo);
                Img::updateOrCreate(
                    [
                        'product_id' => $discount->id,
                        'type' => 7,
                        'img_index' => 1
                    ],
                    ['path' => $logo]
                );
            }
            DB::commit();
            return Redirect::route('admin.discount.index');
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
