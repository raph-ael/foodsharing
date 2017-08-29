<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBellTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_bell', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->nullable();
			$table->string('body', 50)->nullable();
			$table->text('vars', 65535)->nullable();
			$table->string('attr', 500)->nullable();
			$table->string('icon', 150)->nullable();
			$table->string('identifier', 40)->nullable();
			$table->dateTime('time');
			$table->boolean('closeable')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_bell');
	}

}
