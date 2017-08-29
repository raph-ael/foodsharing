<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasBellTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_bell', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_bell_FKIndex1');
			$table->integer('bell_id')->unsigned()->index('foodsaver_has_bell_FKIndex2');
			$table->boolean('seen')->nullable()->default(0);
			$table->primary(['foodsaver_id','bell_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_bell');
	}

}
