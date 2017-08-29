<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsPassGenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_pass_gen', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_pass_gen_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('bot_id', 'fs_pass_gen_ibfk_2')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_pass_gen', function(Blueprint $table)
		{
			$table->dropForeign('fs_pass_gen_ibfk_1');
			$table->dropForeign('fs_pass_gen_ibfk_2');
		});
	}

}
