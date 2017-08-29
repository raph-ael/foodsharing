<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsThemePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_theme_post', function(Blueprint $table)
		{
			$table->foreign('theme_id', 'fs_theme_post_ibfk_1')->references('id')->on('fs_theme')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_theme_post', function(Blueprint $table)
		{
			$table->dropForeign('fs_theme_post_ibfk_1');
		});
	}

}
