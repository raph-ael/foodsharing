<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_question', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('text', 65535)->nullable();
			$table->integer('duration')->unsigned();
			$table->string('wikilink', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_question');
	}

}
