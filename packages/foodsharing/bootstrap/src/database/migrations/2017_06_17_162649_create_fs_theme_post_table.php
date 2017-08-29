<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsThemePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_theme_post', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('theme_id')->unsigned()->index('theme_post_FKIndex2');
			$table->integer('foodsaver_id')->unsigned()->index('theme_post_FKIndex1');
			$table->integer('reply_post')->unsigned()->default(0)->index('reply_post');
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
		Schema::drop('fs_theme_post');
	}

}
