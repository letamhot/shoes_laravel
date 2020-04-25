<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->integer('gender_id')->unsigned()->nullable()->index('customer_gender_foreign');
			$table->string('email')->nullable();
			$table->string('address')->nullable();
			$table->string('postcode')->nullable();
			$table->text('image')->nullable();
			$table->string('city')->nullable();
			$table->bigInteger('phone')->nullable();
			$table->string('note')->nullable();
			$table->boolean('active')->nullable()->default(0);
			$table->string('user_created')->nullable();
			$table->string('user_updated')->nullable();
			$table->string('user_deleted')->nullable();
			$table->integer('users')->unsigned()->nullable()->index('customer_users_foreign');
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
		Schema::drop('customer');
	}

}
