<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('report_FKIndex1');
			$table->integer('reporter_id')->unsigned()->nullable()->index('report_reporter');
			$table->boolean('reporttype')->nullable();
			$table->integer('betrieb_id')->unsigned()->nullable()->index('report_betrieb');
			$table->dateTime('time')->nullable();
			$table->boolean('committed')->nullable()->default(0);
			$table->text('msg', 65535)->nullable();
			$table->string('tvalue', 300)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_report');
	}

}
