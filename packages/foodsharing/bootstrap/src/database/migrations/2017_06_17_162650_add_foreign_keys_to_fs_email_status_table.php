<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsEmailStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_email_status', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_email_status_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('email_id', 'fs_email_status_ibfk_2')->references('id')->on('fs_send_email')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_email_status', function(Blueprint $table)
		{
			$table->dropForeign('fs_email_status_ibfk_1');
			$table->dropForeign('fs_email_status_ibfk_2');
		});
	}

}
