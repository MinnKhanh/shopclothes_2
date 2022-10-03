<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
   protected $typenav;
   public function __construct()
   {
      //  DB::enableQueryLog();
      $configs = SystemConfigController::getAndCache();
      $this->typenav = $configs['type']; //Type::with('Img', 'Categories')->withCount('Product')->get()->toArray();
      //  dd(DB::getQueryLog());
      View::share('numerberOfcart', Session('cart') ? Session('cart')->getTotalQuantity() : 0);
   }
}
