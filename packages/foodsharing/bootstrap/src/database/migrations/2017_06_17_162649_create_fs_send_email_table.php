<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsSendEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_send_email', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('send_email_FKIndex1');
			$table->integer('mailbox_id')->unsigned();
			$table->boolean('mode')->default(1);
			$table->boolean('complete')->default(0);
			$table->string('name', 200)->nullable();
			$table->text('message', 65535)->nullable();
			$table->dateTime('zeit')->nullable();
			$table->text('recip', 65535)->nullable();
			$table->string('attach', 500);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_send_email');
	}

}
