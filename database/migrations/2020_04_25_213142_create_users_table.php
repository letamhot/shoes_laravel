<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('email')->unique();
			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
			$table->text('image', 65535)->nullable();
			$table->boolean('gender')->nullable();
			$table->string('address')->nullable();
			$table->string('phone', 20)->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password')->nullable();
			$table->integer('id_role')->unsigned()->nullable()->index('users_id_role_foreign');
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
