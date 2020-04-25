<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_bill')->unsigned()->index('bills_detail_id_bill_foreign');
			$table->integer('id_product')->unsigned()->index('bills_detail_id_product_foreign');
			$table->string('name_product')->nullable();
			$table->integer('size')->nullable()->index('size');
			$table->integer('quantity')->comment('Số lượng');
			$table->float('unit_price', 10, 0);
			$table->float('total_price', 30)->nullable();
			$table->boolean('status')->nullable()->default(0);
			$table->string('user_created')->nullable();
			$table->string('user_updated')->nullable();
			$table->string('user_deleted')->nullable();
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
		Schema::drop('bills_detail');
	}

}
