<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFairteilerHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_fairteiler_has_wallpost', function(Blueprint $table)
		{
			$table->integer('fairteiler_id')->unsigned()->index('fairteiler_has_wallpost_FKIndex1');
			$table->integer('wallpost_id')->unsigned()->index('fairteiler_has_wallpost_FKIndex2');
			$table->primary(['fairteiler_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_fairteiler_has_wallpost');
	}

}
