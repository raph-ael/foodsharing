<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver_has_wallpost', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->boolean('usercomment')->default(0);
			$table->primary(['foodsaver_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver_has_wallpost');
	}

}
