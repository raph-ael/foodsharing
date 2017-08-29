<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFsreportHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_fsreport_has_wallpost', function(Blueprint $table)
		{
			$table->integer('fsreport_id')->unsigned()->index('fsreport_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->primary(['fsreport_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_fsreport_has_wallpost');
	}

}
