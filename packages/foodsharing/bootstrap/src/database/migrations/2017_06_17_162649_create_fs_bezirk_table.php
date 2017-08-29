<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBezirkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_bezirk', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable()->default(0)->index('parent_id');
			$table->boolean('has_children');
			$table->boolean('type')->default(1)->index('type');
			$table->text('teaser', 65535)->nullable();
			$table->text('desc', 65535)->nullable();
			$table->string('photo', 200)->default('');
			$table->integer('master')->unsigned()->default(0)->index('master');
			$table->integer('mailbox_id')->unsigned()->default(0)->index('mailbox_id');
			$table->string('name', 50)->nullable();
			$table->string('email', 120)->default('');
			$table->string('email_pass', 50)->default('');
			$table->string('email_name', 100)->default('');
			$table->boolean('apply_type')->default(2);
			$table->boolean('banana_count')->default(0)->default(0);
			$table->boolean('fetch_count')->default(0)->default(0);
			$table->boolean('week_num')->default(0)->default(0);
			$table->boolean('report_num')->default(0);
			$table->dateTime('stat_last_update')->default('1970-01-01 00:00:00');
			$table->decimal('stat_fetchweight', 10)->unsigned()->default(0);
			$table->integer('stat_fetchcount')->unsigned()->default(0);
			$table->integer('stat_postcount')->unsigned()->default(0);
			$table->integer('stat_betriebcount')->unsigned()->default(0);
			$table->integer('stat_korpcount')->unsigned()->default(0);
			$table->integer('stat_botcount')->unsigned()->default(0);
			$table->integer('stat_fscount')->unsigned()->default(0);
			$table->integer('stat_fairteilercount')->unsigned()->default(0);
			$table->integer('conversation_id')->unsigned()->default(0);
			$table->boolean('moderated')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_bezirk');
	}

}
