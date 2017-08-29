<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasBezirkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_bezirk', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_bezirk_FKIndex1');
			$table->integer('bezirk_id')->unsigned()->index('foodsaver_has_bezirk_FKIndex2');
			$table->integer('active')->unsigned()->nullable()->default(0)->comment('0=beworben,1=aktiv,10=vielleicht');
			$table->dateTime('added');
			$table->text('application', 65535);
			$table->primary(['foodsaver_id','bezirk_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_bezirk');
	}

}
