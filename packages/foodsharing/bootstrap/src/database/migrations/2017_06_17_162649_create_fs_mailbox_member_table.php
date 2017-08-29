<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsMailboxMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_mailbox_member', function(Blueprint $table)
		{
			$table->integer('mailbox_id')->unsigned()->index('mailbox_has_foodsaver_FKIndex1');
			$table->integer('foodsaver_id')->unsigned()->index('mailbox_has_foodsaver_FKIndex2');
			$table->string('email_name', 120);
			$table->primary(['mailbox_id','foodsaver_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_mailbox_member');
	}

}
