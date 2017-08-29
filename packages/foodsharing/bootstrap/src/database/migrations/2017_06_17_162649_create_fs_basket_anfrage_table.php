<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBasketAnfrageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_basket_anfrage', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_basket_FKIndex1');
			$table->integer('basket_id')->unsigned()->index('foodsaver_has_basket_FKIndex2');
			$table->boolean('status')->nullable();
			$table->dateTime('time');
			$table->boolean('appost')->default(0);
			$table->primary(['foodsaver_id','basket_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_basket_anfrage');
	}

}
