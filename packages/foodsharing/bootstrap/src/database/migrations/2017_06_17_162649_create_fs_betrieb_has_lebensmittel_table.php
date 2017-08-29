<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBetriebHasLebensmittelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_betrieb_has_lebensmittel', function(Blueprint $table)
		{
			$table->integer('betrieb_id')->unsigned();
			$table->integer('lebensmittel_id')->unsigned();
			$table->primary(['betrieb_id','lebensmittel_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_betrieb_has_lebensmittel');
	}

}
