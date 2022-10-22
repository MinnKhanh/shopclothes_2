<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->float('persent');
            $table->date('begin');
            $table->date('end');
            $table->softDeletes();
            $table->timestamps();
            $table->string('code');
            $table->string('discription')->nullable();
            $table->integer('unit');
            $table->integer('show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_discount');
    }
}
