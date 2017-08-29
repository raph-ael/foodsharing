<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsThemeFollowerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_theme_follower', function(Blueprint $table)
		{
			$table->foreign('theme_id', 'fs_theme_follower_ibfk_1')->references('id')->on('fs_theme')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('foodsaver_id', 'fs_theme_follower_ibfk_2')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_theme_follower', function(Blueprint $table)
		{
			$table->dropForeign('fs_theme_follower_ibfk_1');
			$table->dropForeign('fs_theme_follower_ibfk_2');
		});
	}

}
