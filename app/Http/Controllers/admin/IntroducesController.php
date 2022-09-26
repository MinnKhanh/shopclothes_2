<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Img;
use App\Models\Introduce;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class IntroducesController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
        parent::__construct();
    }
    public function banner(Request $request)
    {
        return view('admin.introduce.banner', ['typenav' => $this->typenav]);
    }
    public function editIntroDiscount(Request $request)
    {
        $discount = Discount::get()->toArray();
        return view('admin.introduce.edit', ['typenav' => $this->typenav, 'discount' => $discount, 'type' => 1, 'index' => $request->input('index')]);
    }
    public function editIntroMain(Request $request)
    {
        return view('admin.introduce.edit', ['typenav' => $this->typenav, 'type' => 2, 'index' => $request->input('index')]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'index' => 'required',
            'description' => 'required',
            'type' => 'required',
            'photo' => 'required',
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            //dd($request->all());
            $introduce = new Introduce();
            if ($request->input('id')) {
                $introduce = Introduce::where('id', $request->input('id'))->first();
            }
            $introduce->title = $request->input('title');
            $introduce->description = $request->input('description');
            $introduce->index = $request->input('index');
            $introduce->type = $request->input('type');
            if ($request->input('relate_id'))
                $introduce->relate_id = $request->input('relate_id');
            $introduce->save();
            if ($request->file('photo')) {
                $logo = optional($request->file('photo'))->store('public/introduct_img');
                $logo = str_replace("public/", "", $logo);
                Img::updateOrCreate(
                    [
                        'product_id' => $introduce->id,
                        'type' => 8,
                        'img_index' => 1
                    ],
                    ['path' => $logo]
                );
            }
            DB::commit();
            return Redirect::route('admin.introduce.banner');
        } catch (Throwable $e) {
            DB::rollBack();
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
