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
            $table->foreign('type')->references('id')->on('type')->onDelete('cascade');
            $table->integer('producer')->unsigned();
            $table->foreign('producer')->references('id')->on('producer')->onDelete('cascade');
            $table->integer('amount')->nullable();
            $table->longtext('image')->nullable();
            $table->float('price_input', 20, 2)->nullable();
            $table->float('promotion_price', 20, 2)->nullable()->default(0);
            $table->boolean('new')->nullable()->default(0);
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