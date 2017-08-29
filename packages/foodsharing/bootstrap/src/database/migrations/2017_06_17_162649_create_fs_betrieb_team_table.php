<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBetriebTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_betrieb_team', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_has_betrieb_FKIndex1');
			$table->integer('betrieb_id')->unsigned()->index('foodsaver_has_betrieb_FKIndex2');
			$table->boolean('verantwortlich')->nullable()->default(0);
			$table->integer('active')->default(0);
			$table->dateTime('stat_last_update')->nullable();
			$table->integer('stat_fetchcount')->unsigned()->nullable();
			$table->date('stat_first_fetch')->nullable();
			$table->dateTime('stat_last_fetch')->nullable();
			$table->date('stat_add_date')->nullable();
			$table->primary(['foodsaver_id','betrieb_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_betrieb_team');
	}

}
