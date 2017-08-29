<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBuddyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_buddy', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned();
			$table->integer('buddy_id')->unsigned()->index('buddy_id');
			$table->boolean('confirmed')->nullable()->index('buddy_confirmed');
			$table->primary(['foodsaver_id','buddy_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_buddy');
	}

}
