<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBezirkClosureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_bezirk_closure', function(Blueprint $table)
		{
			$table->integer('bezirk_id')->unsigned()->index('bezirk_id');
			$table->integer('ancestor_id')->unsigned()->index('ancestor_id');
			$table->integer('depth')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_bezirk_closure');
	}

}
