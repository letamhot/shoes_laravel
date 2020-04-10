<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducerTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producer_type', function (Blueprint $table) {
            $table->integer('id_producer')->unsigned();
            $table->foreign('id_producer')->references('id')->on('producer')->onDelete('cascade');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('type')->onDelete('cascade');
            $table->primary(array('id_producer', 'id_type'));
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producer_type');
    }
}