<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsQuestionHasQuizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_question_has_quiz', function(Blueprint $table)
		{
			$table->integer('question_id')->unsigned()->index('question_has_quiz_FKIndex1');
			$table->integer('quiz_id')->unsigned()->index('question_has_quiz_FKIndex2');
			$table->boolean('fp')->nullable();
			$table->primary(['question_id','quiz_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_question_has_quiz');
	}

}
