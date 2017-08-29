<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsBotschafterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_botschafter', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_botschafter_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('bezirk_id', 'fs_botschafter_ibfk_2')->references('id')->on('fs_bezirk')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_botschafter', function(Blueprint $table)
		{
			$table->dropForeign('fs_botschafter_ibfk_1');
			$table->dropForeign('fs_botschafter_ibfk_2');
		});
	}

}
