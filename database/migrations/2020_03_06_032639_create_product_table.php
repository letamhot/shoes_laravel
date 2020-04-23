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
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('type')->onDelete('cascade');
            $table->integer('id_producer')->unsigned();
            $table->foreign('id_producer')->references('id')->on('producer')->onDelete('cascade');
            $table->integer('amount')->nullable();
            $table->longtext('image')->nullable();
            $table->integer('price_input')->nullable();
            $table->integer('promotion_price')->nullable()->default(0);
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