<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsFairteilerFollowerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_fairteiler_follower', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_fairteiler_follower_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('fairteiler_id', 'fs_fairteiler_follower_ibfk_2')->references('id')->on('fs_fairteiler')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_fairteiler_follower', function(Blueprint $table)
		{
			$table->dropForeign('fs_fairteiler_follower_ibfk_1');
			$table->dropForeign('fs_fairteiler_follower_ibfk_2');
		});
	}

}
