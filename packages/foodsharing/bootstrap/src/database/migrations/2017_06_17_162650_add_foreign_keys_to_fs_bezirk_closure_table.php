<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsBezirkClosureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_bezirk_closure', function(Blueprint $table)
		{
			$table->foreign('bezirk_id', 'fs_bezirk_closure_ibfk_1')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ancestor_id', 'fs_bezirk_closure_ibfk_2')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('bezirk_id', 'fs_bezirk_closure_ibfk_3')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ancestor_id', 'fs_bezirk_closure_ibfk_4')->references('id')->on('fs_bezirk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_bezirk_closure', function(Blueprint $table)
		{
			$table->dropForeign('fs_bezirk_closure_ibfk_1');
			$table->dropForeign('fs_bezirk_closure_ibfk_2');
			$table->dropForeign('fs_bezirk_closure_ibfk_3');
			$table->dropForeign('fs_bezirk_closure_ibfk_4');
		});
	}

}
