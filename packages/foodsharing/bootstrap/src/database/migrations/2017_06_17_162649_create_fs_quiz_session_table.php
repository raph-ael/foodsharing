<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsQuizSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_quiz_session', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('quiz_result_FKIndex2');
			$table->integer('quiz_id')->unsigned()->index('quiz_result_FKIndex1');
			$table->boolean('status')->nullable();
			$table->boolean('quiz_index')->nullable();
			$table->text('quiz_questions', 65535)->nullable();
			$table->text('quiz_result', 65535)->nullable();
			$table->dateTime('time_start')->nullable();
			$table->dateTime('time_end')->nullable();
			$table->decimal('fp', 5)->nullable();
			$table->boolean('maxfp')->nullable();
			$table->boolean('quest_count')->nullable();
			$table->boolean('easymode')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_quiz_session');
	}

}
