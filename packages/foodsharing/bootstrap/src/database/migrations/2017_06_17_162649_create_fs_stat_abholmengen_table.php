<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsStatAbholmengenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_stat_abholmengen', function(Blueprint $table)
		{
			$table->integer('betrieb_id')->unsigned();
			$table->dateTime('date');
			$table->decimal('abholmenge', 5, 1);
			$table->unique(['betrieb_id','date'], 'betrieb_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_stat_abholmengen');
	}

}
