<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBasketHasArtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_basket_has_art', function(Blueprint $table)
		{
			$table->integer('basket_id')->unsigned();
			$table->integer('art_id')->unsigned();
			$table->primary(['basket_id','art_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_basket_has_art');
	}

}
