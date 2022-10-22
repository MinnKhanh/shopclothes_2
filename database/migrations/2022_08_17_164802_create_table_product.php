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
            $table->bigInteger('category')->unsigned()->nullable();
            $table->float('priceImport')->nullable();
            $table->float('priceSell')->nullable();
            $table->bigInteger('type')->unsigned();
            $table->bigInteger('supplier')->unsigned();
            $table->softDeletes();
            $table->bigInteger('brand')->unsigned();
            $table->string('code');
            $table->integer('status');
            $table->integer('featured');
            $table->integer('gender');
            $table->timestamps();
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
