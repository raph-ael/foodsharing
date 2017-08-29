<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsApplicationHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_application_has_wallpost', function(Blueprint $table)
		{
			$table->integer('application_id')->unsigned()->index('application_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->primary(['application_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_application_has_wallpost');
	}

}
