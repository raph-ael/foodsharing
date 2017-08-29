<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsAbholerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_abholer', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned();
			$table->integer('betrieb_id')->unsigned()->index('betrieb_id');
			$table->dateTime('date');
			$table->boolean('confirmed')->default(0);
			$table->primary(['foodsaver_id','betrieb_id','date']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_abholer');
	}

}
