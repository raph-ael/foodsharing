<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsThemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_theme', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('theme_FKIndex1');
			$table->integer('last_post_id')->unsigned()->default(0)->index('last_post_id');
			$table->string('name', 260)->nullable();
			$table->dateTime('time')->nullable();
			$table->boolean('active')->default(1)->index('active');
			$table->boolean('sticky')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_theme');
	}

}
