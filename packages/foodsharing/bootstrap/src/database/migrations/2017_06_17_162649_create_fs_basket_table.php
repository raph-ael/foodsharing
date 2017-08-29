<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFsBasketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fs_basket', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('foodsaver_id')->unsigned()->index('basket_FKIndex1');
			$table->boolean('status')->nullable();
			$table->dateTime('time')->nullable();
			$table->date('until');
			$table->dateTime('fetchtime')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('picture', 150)->nullable();
			$table->string('tel', 50)->default('');
			$table->string('handy', 50)->default('');
			$table->string('contact_type', 20)->default('1');
			$table->boolean('location_type')->nullable();
			$table->float('weight', 10, 0)->nullable();
			$table->float('lat', 10, 6)->default(0.000000);
			$table->float('lon', 10, 6)->default(0.000000);
			$table->integer('bezirk_id')->unsigned()->index('bezirk_id');
			$table->integer('fs_id')->default(0)->index('fs_id');
			$table->boolean('appost');
			$table->index(['lat','lon'], 'lat');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fs_basket');
	}

}
