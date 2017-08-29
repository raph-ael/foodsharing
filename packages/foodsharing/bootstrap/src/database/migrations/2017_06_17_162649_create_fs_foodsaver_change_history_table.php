<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverChangeHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_change_history', function(Blueprint $table)
		{
			$table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('fs_id')->index('fs_id');
			$table->integer('changer_id');
			$table->text('object_name', 65535);
			$table->text('old_value', 65535)->nullable();
			$table->text('new_value', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_change_history');
	}

}
