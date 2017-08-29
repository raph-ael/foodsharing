<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsMsgTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_msg', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('conversation_id')->unsigned()->index('message_FKIndex2');
			$table->integer('foodsaver_id')->unsigned()->index('message_FKIndex1');
			$table->text('body', 65535)->nullable();
			$table->dateTime('time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_msg');
	}

}
