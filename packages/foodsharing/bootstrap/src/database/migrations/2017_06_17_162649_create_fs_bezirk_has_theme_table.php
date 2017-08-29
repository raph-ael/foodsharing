<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBezirkHasThemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_bezirk_has_theme', function(Blueprint $table)
		{
			$table->integer('theme_id')->unsigned();
			$table->integer('bezirk_id')->unsigned()->index('bezirk_id');
			$table->boolean('bot_theme')->default(0);
			$table->primary(['theme_id','bezirk_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_bezirk_has_theme');
	}

}
