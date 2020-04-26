<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('commenter_id')->nullable();
			$table->string('commenter_type')->nullable();
			$table->string('guest_name')->nullable();
			$table->string('guest_email')->nullable();
			$table->string('commentable_type');
			$table->string('commentable_id');
			$table->text('comment', 65535);
			$table->boolean('approved')->default(1);
			$table->bigInteger('child_id')->unsigned()->nullable()->index('comments_child_id_foreign');
			$table->timestamps();
			$table->index(['commentable_type','commentable_id']);
			$table->index(['commenter_id','commenter_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
