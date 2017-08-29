<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBlogEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_blog_entry', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bezirk_id')->unsigned()->index('blog_entry_FKIndex2');
			$table->integer('foodsaver_id')->unsigned()->index('blog_entry_FKIndex1');
			$table->boolean('active')->index('active');
			$table->string('name', 100)->nullable();
			$table->string('teaser', 500)->nullable();
			$table->text('body', 65535)->nullable();
			$table->dateTime('time')->nullable();
			$table->string('picture', 150);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_blog_entry');
	}

}
