<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBasketHasWallpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_basket_has_wallpost', function(Blueprint $table)
		{
			$table->integer('basket_id')->unsigned()->index('basket_id');
			$table->integer('wallpost_id')->unsigned()->index('wallpost_id');
			$table->primary(['basket_id','wallpost_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_basket_has_wallpost');
	}

}
