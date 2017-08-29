<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsFoodsaverHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_foodsaver_has_wallpost', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_foodsaver_has_wallpost_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('wallpost_id', 'fs_foodsaver_has_wallpost_ibfk_2')->references('id')->on('fs_wallpost')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_foodsaver_has_wallpost', function(Blueprint $table)
		{
			$table->dropForeign('fs_foodsaver_has_wallpost_ibfk_1');
			$table->dropForeign('fs_foodsaver_has_wallpost_ibfk_2');
		});
	}

}
