<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_answer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('question_id')->unsigned()->index('answer_FKIndex1');
			$table->text('text', 65535)->nullable();
			$table->text('explanation', 65535)->nullable();
			$table->boolean('right')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_answer');
	}

}
