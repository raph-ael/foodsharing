<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_contact', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->default(0);
			$table->integer('contact_id')->unsigned()->default(0)->index('contact_id');
			$table->primary(['foodsaver_id','contact_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_contact');
	}

}
