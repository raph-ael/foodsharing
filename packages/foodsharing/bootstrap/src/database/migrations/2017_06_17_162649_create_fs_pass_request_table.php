<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsPassRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_pass_request', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->primary();
			$table->string('name', 50)->nullable();
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
		Schema::drop('fs_pass_request');
	}

}
