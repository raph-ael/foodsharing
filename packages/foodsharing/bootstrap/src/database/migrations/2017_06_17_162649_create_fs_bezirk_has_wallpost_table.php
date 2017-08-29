<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBezirkHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_bezirk_has_wallpost', function(Blueprint $table)
		{
			$table->integer('bezirk_id')->unsigned()->index('bezirk_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->primary(['bezirk_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_bezirk_has_wallpost');
	}

}
