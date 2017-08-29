<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_answer', function(Blueprint $table)
		{
			$table->foreign('question_id', 'fs_answer_ibfk_1')->references('id')->on('fs_question')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_answer', function(Blueprint $table)
		{
			$table->dropForeign('fs_answer_ibfk_1');
		});
	}

}
