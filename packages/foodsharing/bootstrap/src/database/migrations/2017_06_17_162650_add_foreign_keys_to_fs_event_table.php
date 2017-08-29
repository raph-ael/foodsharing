<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_event', function(Blueprint $table)
		{
			$table->foreign('bezirk_id', 'fs_event_ibfk_1')->references('id')->on('fs_bezirk')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('location_id', 'fs_event_ibfk_2')->references('id')->on('fs_location')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_event', function(Blueprint $table)
		{
			$table->dropForeign('fs_event_ibfk_1');
			$table->dropForeign('fs_event_ibfk_2');
		});
	}

}
