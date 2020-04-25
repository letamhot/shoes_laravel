<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('id_type')->unsigned()->index('product_type_foreign');
			$table->integer('id_producer')->unsigned()->index('product_producer_foreign');
			$table->integer('amount')->nullable();
			$table->text('image')->nullable();
			$table->integer('price_input')->nullable();
			$table->integer('promotion_price')->nullable()->default(0);
			$table->boolean('new')->nullable()->default(0);
			$table->text('description', 16777215)->nullable();
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
		Schema::drop('product');
	}

}
