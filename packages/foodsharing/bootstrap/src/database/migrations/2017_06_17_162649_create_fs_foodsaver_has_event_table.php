<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_event', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_event_FKIndex1');
			$table->integer('event_id')->unsigned()->index('foodsaver_has_event_FKIndex2');
			$table->boolean('status')->default(0);
			$table->primary(['foodsaver_id','event_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_event');
	}

}
