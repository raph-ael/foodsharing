<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsQuestionHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_question_has_wallpost', function(Blueprint $table)
		{
			$table->foreign('question_id', 'fs_question_has_wallpost_ibfk_1')->references('id')->on('fs_question')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('wallpost_id', 'fs_question_has_wallpost_ibfk_2')->references('id')->on('fs_wallpost')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_question_has_wallpost', function(Blueprint $table)
		{
			$table->dropForeign('fs_question_has_wallpost_ibfk_1');
			$table->dropForeign('fs_question_has_wallpost_ibfk_2');
		});
	}

}
