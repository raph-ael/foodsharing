<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsMailchangeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_mailchange', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->primary();
			$table->string('newmail', 200)->nullable();
			$table->dateTime('time')->nullable();
			$table->string('token', 300)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_mailchange');
	}

}
