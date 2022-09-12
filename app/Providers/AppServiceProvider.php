<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\ProductDetail;
use App\Models\Products;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            1 => Products::class,
            5 => Brand::class,
            2 => ProductDetail::class,
            3 => Type::class,
            4 => Categories::class,
            6 => User::class
        ]);
    }
}
