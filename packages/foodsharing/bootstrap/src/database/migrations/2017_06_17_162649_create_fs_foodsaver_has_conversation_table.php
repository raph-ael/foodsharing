<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasConversationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_conversation', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_conversation_FKIndex1');
			$table->integer('conversation_id')->unsigned()->index('foodsaver_has_conversation_FKIndex2');
			$table->boolean('unread')->nullable()->default(1)->index('unread');
			$table->primary(['foodsaver_id','conversation_id'],'fs_hc_primary');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_conversation');
	}

}
