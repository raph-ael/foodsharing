<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsBezirkHasThemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_bezirk_has_theme', function(Blueprint $table)
		{
			$table->foreign('bezirk_id', 'fs_bezirk_has_theme_ibfk_1')->references('id')->on('fs_bezirk')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('theme_id', 'fs_bezirk_has_theme_ibfk_2')->references('id')->on('fs_theme')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_bezirk_has_theme', function(Blueprint $table)
		{
			$table->dropForeign('fs_bezirk_has_theme_ibfk_1');
			$table->dropForeign('fs_bezirk_has_theme_ibfk_2');
		});
	}

}
