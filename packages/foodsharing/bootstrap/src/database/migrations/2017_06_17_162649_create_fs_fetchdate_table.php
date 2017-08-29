<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFetchdateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_fetchdate', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('betrieb_id')->unsigned()->index('fetchdate_FKIndex1');
			$table->dateTime('time')->nullable();
			$table->boolean('fetchercount')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_fetchdate');
	}

}
