<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsFairteilerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_fairteiler', function(Blueprint $table)
		{
			$table->foreign('bezirk_id', 'fs_fairteiler_ibfk_1')->references('id')->on('fs_bezirk')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_fairteiler', function(Blueprint $table)
		{
			$table->dropForeign('fs_fairteiler_ibfk_1');
		});
	}

}
