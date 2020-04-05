<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('name');
            $table->integer('type')->unsigned();
            $table->foreign('type')->references('id')->on('type');
            $table->integer('producer')->unsigned();
            $table->foreign('producer')->references('id')->on('producer');
            $table->integer('amount');
            $table->text('image')->nullable();
            $table->string('price_input');
            $table->mediumText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    // đm tạo db khác
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