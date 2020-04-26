<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_customer')->unsigned()->nullable()->index('bills_id_customer_foreign');
			$table->date('date_order')->nullable();
			$table->string('total', 100)->nullable();
			$table->string('payment')->nullable();
			$table->boolean('pay_money')->nullable()->default(0);
			$table->boolean('status')->nullable()->default(0);
			$table->text('note', 65535)->nullable();
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
		Schema::drop('bills');
	}

}
