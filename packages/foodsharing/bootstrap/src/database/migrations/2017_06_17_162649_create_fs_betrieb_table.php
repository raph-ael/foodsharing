<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBetriebTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_betrieb', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('betrieb_status_id')->unsigned()->index('betrieb_FKIndex5');
			$table->integer('bezirk_id')->unsigned()->index('betrieb_FKIndex3');
			$table->date('added');
			$table->string('plz', 5)->index('plz');
			$table->string('stadt', 50);
			$table->string('lat', 20)->nullable();
			$table->string('lon', 20)->nullable();
			$table->integer('kette_id')->unsigned()->nullable()->index('betrieb_FKIndex2');
			$table->integer('betrieb_kategorie_id')->nullable();
			$table->string('name', 120)->nullable();
			$table->string('str', 120)->nullable();
			$table->string('hsnr', 20)->nullable();
			$table->date('status_date')->nullable();
			$table->boolean('status')->nullable();
			$table->string('ansprechpartner', 60)->nullable();
			$table->string('telefon', 50)->nullable();
			$table->string('fax', 50)->nullable();
			$table->string('email', 60)->nullable();
			$table->date('begin')->nullable();
			$table->text('besonderheiten', 65535)->nullable();
			$table->string('public_info', 200)->nullable();
			$table->boolean('public_time');
			$table->boolean('ueberzeugungsarbeit');
			$table->boolean('presse');
			$table->boolean('sticker');
			$table->boolean('abholmenge');
			$table->boolean('team_status')->default(1)->index('team_status')->comment('0 = Team Voll; 1 = Es werden noch Helfer gesucht; 2 = Es werden dringend Helfer gesucht');
			$table->integer('prefetchtime')->unsigned()->default(1209600);
			$table->integer('team_conversation_id')->unsigned()->nullable();
			$table->integer('springer_conversation_id')->unsigned()->nullable();
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
		Schema::drop('fs_betrieb');
	}

}
