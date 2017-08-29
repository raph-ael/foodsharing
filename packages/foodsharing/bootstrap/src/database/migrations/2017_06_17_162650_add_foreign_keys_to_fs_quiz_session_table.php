<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsQuizSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_quiz_session', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_quiz_session_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_quiz_session', function(Blueprint $table)
		{
			$table->dropForeign('fs_quiz_session_ibfk_1');
		});
	}

}
