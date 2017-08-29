<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsMailboxMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_mailbox_message', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mailbox_id')->unsigned()->index('mailbox_message_FKIndex1');
			$table->boolean('folder')->nullable()->default(1)->index('email_message_folder');
			$table->string('sender', 120)->nullable();
			$table->text('to', 65535);
			$table->string('subject', 120)->nullable();
			$table->text('body', 65535)->nullable();
			$table->text('body_html', 65535);
			$table->dateTime('time')->nullable();
			$table->text('attach', 65535)->nullable();
			$table->boolean('read')->nullable();
			$table->boolean('answer')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_mailbox_message');
	}

}
