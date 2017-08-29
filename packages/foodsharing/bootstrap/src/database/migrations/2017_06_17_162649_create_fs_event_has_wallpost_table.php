<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsEventHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_event_has_wallpost', function(Blueprint $table)
		{
			$table->integer('event_id')->unsigned()->index('event_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->primary(['event_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_event_has_wallpost');
	}

}
