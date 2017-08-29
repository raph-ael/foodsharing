<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsUsernotesHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_usernotes_has_wallpost', function(Blueprint $table)
		{
			$table->integer('usernotes_id')->unsigned()->index('usernotes_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->boolean('usercomment')->default(0);
			$table->primary(['usernotes_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_usernotes_has_wallpost');
	}

}
