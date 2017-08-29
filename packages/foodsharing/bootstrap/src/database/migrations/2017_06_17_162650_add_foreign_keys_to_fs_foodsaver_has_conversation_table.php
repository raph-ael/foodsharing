<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsFoodsaverHasConversationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_foodsaver_has_conversation', function(Blueprint $table)
		{
			$table->foreign('conversation_id', 'fs_foodsaver_has_conversation_ibfk_1')->references('id')->on('fs_conversation')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_foodsaver_has_conversation', function(Blueprint $table)
		{
			$table->dropForeign('fs_foodsaver_has_conversation_ibfk_1');
		});
	}

}
