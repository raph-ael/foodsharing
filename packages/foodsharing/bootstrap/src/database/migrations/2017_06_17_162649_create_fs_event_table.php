<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_event', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('event_FKIndex3');
			$table->integer('bezirk_id')->unsigned()->nullable()->index('event_FKIndex2');
			$table->integer('location_id')->unsigned()->nullable()->index('event_FKIndex1');
			$table->boolean('public')->default(0);
			$table->string('name', 200)->nullable();
			$table->dateTime('start');
			$table->dateTime('end');
			$table->text('description', 65535)->nullable();
			$table->boolean('bot')->nullable()->default(0);
			$table->boolean('online')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_event');
	}

}
