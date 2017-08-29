<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsIpblockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_ipblock', function(Blueprint $table)
		{
			$table->string('ip', 20);
			$table->string('context', 10);
			$table->dateTime('start')->nullable();
			$table->integer('duration')->unsigned()->nullable();
			$table->primary(['ip','context']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_ipblock');
	}

}
