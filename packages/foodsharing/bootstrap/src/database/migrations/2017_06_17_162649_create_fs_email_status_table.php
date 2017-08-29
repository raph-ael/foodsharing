<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsEmailStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_email_status', function(Blueprint $table)
		{
			$table->integer('email_id')->unsigned();
			$table->integer('foodsaver_id')->unsigned()->index('foodsaver_id');
			$table->boolean('status')->nullable()->default(0);
			$table->primary(['email_id','foodsaver_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_email_status');
	}

}
