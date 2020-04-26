<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_customer')->unsigned()->nullable();
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade')->nullable();
            $table->date('date_order')->nullable();
            $table->float('total', 20, 2)->nullable();
            $table->string('payment')->nullable();
            $table->boolean('pay_money')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);
            $table->longtext('note')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->string('user_deleted')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
