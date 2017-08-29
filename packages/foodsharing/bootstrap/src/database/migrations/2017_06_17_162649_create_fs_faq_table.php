<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFaqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_faq', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('faq_FKIndex1');
			$table->integer('faq_kategorie_id')->unsigned()->index('faq_kategorie_id');
			$table->string('name', 500)->nullable();
			$table->text('answer', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_faq');
	}

}
