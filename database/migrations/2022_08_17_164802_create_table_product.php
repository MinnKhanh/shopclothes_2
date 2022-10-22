<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->float('priceImport');
            $table->float('priceSell');
            $table->softDeletes();
            $table->timestamps();
            $table->bigInteger('category')->unsigned()->change();
            $table->bigInteger('type')->unsigned()->change();
            $table->bigInteger('brand')->unsigned()->change();
            $table->bigInteger('supplier')->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_product');
    }
}
