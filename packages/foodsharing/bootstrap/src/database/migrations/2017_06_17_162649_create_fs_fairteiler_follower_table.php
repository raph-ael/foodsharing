<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFairteilerFollowerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_fairteiler_follower', function(Blueprint $table)
		{
			$table->integer('fairteiler_id')->unsigned()->index('fairteiler_verantwortlich_FKIndex1');
			$table->integer('foodsaver_id')->unsigned()->index('fairteiler_verantwortlich_FKIndex2');
			$table->boolean('type')->default(1)->index('type');
			$table->boolean('infotype')->default(1)->index('infotype');
			$table->primary(['fairteiler_id','foodsaver_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_fairteiler_follower');
	}

}
