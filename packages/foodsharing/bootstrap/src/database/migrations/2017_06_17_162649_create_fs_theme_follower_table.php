<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsThemeFollowerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_theme_follower', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned();
			$table->integer('theme_id')->unsigned()->index('theme_id');
			$table->boolean('infotype')->index('infotype');
			$table->primary(['foodsaver_id','theme_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_theme_follower');
	}

}
