<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsPassGenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_pass_gen', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned();
			$table->dateTime('date');
			$table->integer('bot_id')->unsigned()->nullable()->index('bot_id');
			$table->primary(['foodsaver_id','date']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_pass_gen');
	}

}
