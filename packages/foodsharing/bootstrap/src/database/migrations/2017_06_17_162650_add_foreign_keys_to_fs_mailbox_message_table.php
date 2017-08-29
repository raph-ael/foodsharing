<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsMailboxMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_mailbox_message', function(Blueprint $table)
		{
			$table->foreign('mailbox_id', 'fs_mailbox_message_ibfk_1')->references('id')->on('fs_mailbox')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_mailbox_message', function(Blueprint $table)
		{
			$table->dropForeign('fs_mailbox_message_ibfk_1');
		});
	}

}
