<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsMailboxMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_mailbox_member', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_mailbox_member_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('mailbox_id', 'fs_mailbox_member_ibfk_2')->references('id')->on('fs_mailbox')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_mailbox_member', function(Blueprint $table)
		{
			$table->dropForeign('fs_mailbox_member_ibfk_1');
			$table->dropForeign('fs_mailbox_member_ibfk_2');
		});
	}

}
