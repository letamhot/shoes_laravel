<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProducerTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producer_type', function(Blueprint $table)
		{
			$table->integer('id_producer')->unsigned();
			$table->integer('id_type')->unsigned()->index('producer_type_id_type_foreign');
			$table->integer('amount');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['id_producer','id_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('producer_type');
	}

}
