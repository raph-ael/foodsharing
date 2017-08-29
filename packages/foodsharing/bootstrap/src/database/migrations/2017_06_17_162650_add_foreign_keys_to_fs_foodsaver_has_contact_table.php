<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFsFoodsaverHasContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fs_foodsaver_has_contact', function(Blueprint $table)
		{
			$table->foreign('foodsaver_id', 'fs_foodsaver_has_contact_ibfk_1')->references('id')->on('fs_foodsaver')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('contact_id', 'fs_foodsaver_has_contact_ibfk_2')->references('id')->on('fs_contact')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fs_foodsaver_has_contact', function(Blueprint $table)
		{
			$table->dropForeign('fs_foodsaver_has_contact_ibfk_1');
			$table->dropForeign('fs_foodsaver_has_contact_ibfk_2');
		});
	}

}
