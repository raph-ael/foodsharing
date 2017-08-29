<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBetriebNotizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_betrieb_notiz', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('betrieb_notiz_FKIndex2');
			$table->integer('betrieb_id')->unsigned()->index('betrieb_notitz_FKIndex1');
			$table->boolean('milestone')->default(0);
			$table->text('text', 65535)->nullable();
			$table->dateTime('zeit')->nullable();
			$table->boolean('last')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_betrieb_notiz');
	}

}
