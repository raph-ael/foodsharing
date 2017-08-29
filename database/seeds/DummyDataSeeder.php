<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * seed users
         */
        $this->call(FsFoodsaverTableSeeder::class);
        $this->call(FsFoodsaverHasBezirkTableSeeder::class);
        $this->call(FsQuizSessionTableSeeder::class);
        $this->call(FsBotschafterTableSeeder::class);

       /*
        * seed stores
        */
        $this->call(FsBetriebKategorieTableSeeder::class);
        $this->call(FsBetriebStatusTableSeeder::class);
        $this->call(FsBetriebTableSeeder::class);

        /*
         * seed fair-share-points
         */
        $this->call(FsFairteilerTableSeeder::class);

    }
}
