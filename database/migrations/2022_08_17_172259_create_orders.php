<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_customer')->unsigned()->nullable();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->float('price', 15, 2);
            $table->integer('quantity');
            $table->integer('type');
            $table->integer('payment_method')->nullable();
            $table->string('note')->nullable();
            $table->string('address')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('status');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('country')->nullable();
            $table->string('city');
            $table->string('district');
            $table->string('zip_code')->nullable();
            $table->double('ship');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
