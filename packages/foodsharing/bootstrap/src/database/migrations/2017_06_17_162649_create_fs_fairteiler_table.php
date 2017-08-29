<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFairteilerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_fairteiler', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bezirk_id')->unsigned()->nullable()->index('fairteiler_FKIndex1');
			$table->string('name', 260)->nullable();
			$table->string('picture', 100);
			$table->boolean('status')->nullable();
			$table->text('desc', 65535)->nullable();
			$table->string('anschrift', 260)->nullable();
			$table->string('plz', 5)->nullable();
			$table->string('ort', 100)->nullable();
			$table->string('lat', 100)->nullable();
			$table->string('lon', 100)->nullable();
			$table->date('add_date')->nullable();
			$table->integer('add_foodsaver')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_fairteiler');
	}

}
