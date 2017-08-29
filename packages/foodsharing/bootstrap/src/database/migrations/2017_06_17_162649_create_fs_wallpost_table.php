<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_wallpost', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('wallpost_FKIndex1');
			$table->text('body', 65535)->nullable();
			$table->dateTime('time')->nullable();
			$table->text('attach', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_wallpost');
	}

}
