<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsVerifyHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_verify_history', function(Blueprint $table)
		{
			$table->integer('fs_id')->unsigned()->nullable()->index('fs_id');
			$table->dateTime('date');
			$table->integer('bot_id')->unsigned()->nullable();
			$table->boolean('change_status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_verify_history');
	}

}
