<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_content', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20)->nullable();
			$table->string('title', 120)->nullable();
			$table->text('body', 65535)->nullable();
			$table->dateTime('last_mod')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_content');
	}

}
