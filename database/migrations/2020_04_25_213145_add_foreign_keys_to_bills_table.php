<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bills', function(Blueprint $table)
		{
			$table->foreign('id_customer')->references('id')->on('customer')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bills', function(Blueprint $table)
		{
			$table->dropForeign('bills_id_customer_foreign');
		});
	}

}
