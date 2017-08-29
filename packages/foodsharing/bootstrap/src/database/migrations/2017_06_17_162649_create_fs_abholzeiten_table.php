<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsAbholzeitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_abholzeiten', function(Blueprint $table)
		{
			$table->integer('betrieb_id')->unsigned();
			$table->boolean('dow');
			$table->time('time')->default('00:00:00');
			$table->boolean('fetcher')->default(4);
			$table->primary(['betrieb_id','dow','time']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_abholzeiten');
	}

}
