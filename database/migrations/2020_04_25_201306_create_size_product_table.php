<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSizeProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('size_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_product')->unsigned()->nullable()->index('size_product_id_product_foreign');
			$table->integer('id_size')->unsigned()->nullable()->index('size_product_id_size_foreign');
			$table->integer('qty')->nullable();
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
		Schema::drop('size_product');
	}

}
