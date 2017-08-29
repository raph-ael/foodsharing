<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsQuestionHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_question_has_wallpost', function(Blueprint $table)
		{
			$table->integer('question_id')->unsigned()->index('question_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->boolean('usercomment')->default(0);
			$table->primary(['question_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_question_has_wallpost');
	}

}
