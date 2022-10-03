<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
        //     ->get()->toArray();
        parent::__construct();
    }
    public function index(Request $request)
    {
        if (auth()->check()) {
            $user = User::with('Img')->where('id', $request->input('id'))->get()->toArray();
            return view('customer.userinfo', ['typenav' => $this->typenav, 'user' => $user[0]]);
        }
    }
    public function updateInfo(Request $request)
    {
        DB::beginTransaction();
        try {

            User::where('id', $request->input('id'))->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'phone' => $request->input('phone')
            ]);
            if ($request->file('photo')) {
                $logo = optional($request->file('photo'))->store('public/user_img');
                $logo = str_replace("public/", "", $logo);
                Img::updateOrCreate(
                    [
                        'product_id' => $request->input('id'),
                        'type' => 6,
                        'img_index' => 1
                    ],
                    ['path' => $logo]
                );
            }
            DB::commit();
            return 0;
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
