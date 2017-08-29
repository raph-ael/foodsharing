<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsEmailBlacklistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_email_blacklist', function(Blueprint $table)
		{
			$table->string('email');
			$table->timestamp('since')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('reason', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_email_blacklist');
	}

}
