<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_rating', function(Blueprint $table)
		{
			$table->integer('foodsaver_id')->unsigned()->index('fk_foodsaver_has_foodsaver_foodsaver_idx');
			$table->integer('rater_id')->unsigned()->index('fk_foodsaver_has_foodsaver_foodsaver1_idx');
			$table->boolean('ratingtype')->default(1);
			$table->boolean('rating')->nullable();
			$table->text('msg', 65535);
			$table->dateTime('time');
			$table->primary(['foodsaver_id','rater_id','ratingtype']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_rating');
	}

}
