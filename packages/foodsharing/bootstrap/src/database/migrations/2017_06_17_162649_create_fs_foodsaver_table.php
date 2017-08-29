<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsFoodsaverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_foodsaver', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bezirk_id')->unsigned()->default(1)->index('foodsaver_FKIndex2');
			$table->string('position')->default('');
			$table->boolean('verified')->default(0);
			$table->dateTime('last_pass')->nullable();
			$table->string('new_bezirk', 120)->nullable();
			$table->boolean('want_new')->default(0)->index('want_new');
			$table->integer('mailbox_id')->unsigned()->default(0)->index('mailbox_id');
			$table->boolean('rolle');
			$table->boolean('type')->nullable()->default(0);
			$table->string('plz', 10)->nullable()->index('plz');
			$table->string('stadt', 100)->nullable();
			$table->string('lat', 20)->nullable();
			$table->string('lon', 20)->nullable();
			$table->string('photo', 50)->nullable();
			$table->boolean('photo_public')->default(0);
			$table->string('email', 120)->nullable()->unique('email');
			$table->string('passwd', 32)->nullable();
			$table->string('name', 120)->nullable();
			$table->boolean('admin')->nullable();
			$table->string('nachname', 120)->nullable();
			$table->string('anschrift', 120)->nullable();
			$table->string('telefon', 30)->nullable();
			$table->string('tox')->nullable();
			$table->string('homepage')->nullable();
			$table->string('github')->nullable();
			$table->string('twitter')->nullable();
			$table->string('handy', 50)->nullable();
			$table->boolean('geschlecht')->nullable();
			$table->date('geb_datum')->nullable();
			$table->dateTime('anmeldedatum')->nullable();
			$table->boolean('orgateam')->nullable()->default(0);
			$table->boolean('active')->default(0);
			$table->text('data', 65535)->nullable();
			$table->text('about_me_public', 65535)->nullable();
			$table->boolean('newsletter')->nullable()->default(0)->index('newsletter');
			$table->string('token', 25);
			$table->boolean('infomail_message')->default(1);
			$table->dateTime('last_login')->nullable();
			$table->decimal('stat_fetchweight', 7)->unsigned()->default(0.00);
			$table->integer('stat_fetchcount')->unsigned()->default(0);
			$table->integer('stat_ratecount')->unsigned()->default(0);
			$table->decimal('stat_rating', 4)->unsigned()->default(0.00);
			$table->integer('stat_postcount')->default(0);
			$table->integer('stat_buddycount')->unsigned()->default(0);
			$table->integer('stat_bananacount')->unsigned()->default(0);
			$table->decimal('stat_fetchrate', 6)->default(100.00);
			$table->boolean('sleep_status')->default(0);
			$table->date('sleep_from')->nullable();
			$table->date('sleep_until')->nullable();
			$table->text('sleep_msg', 500)->nullable();
			$table->date('last_mid')->nullable();
			$table->text('option', 65535)->nullable();
			$table->boolean('beta')->default(0);
			$table->string('fs_password', 50)->nullable();
			$table->boolean('quiz_rolle')->default(0);
			$table->boolean('contact_public')->default(0);
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_foodsaver');
	}

}
