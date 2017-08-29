<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsConversationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_conversation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('locked')->default(0);
			$table->string('name', 40)->nullable();
			$table->dateTime('start')->nullable();
			$table->dateTime('last')->nullable();
			$table->integer('last_foodsaver_id')->unsigned()->nullable()->index('conversation_last_fs_id');
			$table->integer('start_foodsaver_id')->unsigned()->nullable();
			$table->integer('last_message_id')->unsigned()->nullable();
			$table->text('last_message', 65535);
			$table->text('member', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_conversation');
	}

}
