<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("price");
            $table->string("brand")->index();
            $table->string("category")->index();
            $table->string("best_seller")->index();
            $table->string("available")->index();
            $table->string("color")->index();
            $table->string("ranking")->index();
            $table->text("description");
            $table->string("old_price");
            $table->string("image_principal");
            $table->text("images")->nullable();
            $table->string("video")->nullable();
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
        Schema::dropIfExists('product');
    }
}
