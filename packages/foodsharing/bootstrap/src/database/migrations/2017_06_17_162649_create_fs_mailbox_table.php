<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsMailboxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_mailbox', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->nullable()->unique('email_unique');
			$table->boolean('member')->default(0)->nullable()->index('member');
			$table->dateTime('last_access')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_mailbox');
	}

}
