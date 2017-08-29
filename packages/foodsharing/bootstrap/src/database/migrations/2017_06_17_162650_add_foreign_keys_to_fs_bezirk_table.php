<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsBezirkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_bezirk', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'fs_bezirk_ibfk_1')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('parent_id', 'fs_bezirk_ibfk_2')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_bezirk', function(Blueprint $table)
		{
			$table->dropForeign('fs_bezirk_ibfk_1');
			$table->dropForeign('fs_bezirk_ibfk_2');
		});
	}

}
