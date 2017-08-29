<?php

use Illuminate\Database\Seeder;

class FsFoodsaverHasBezirkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_foodsaver_has_bezirk')->delete();
        
        \DB::table('fs_foodsaver_has_bezirk')->insert(array (
            0 => 
            array (
                'foodsaver_id' => 2,
                'bezirk_id' => 4,
                'active' => 1,
                'added' => '2017-08-25 21:51:27',
                'application' => '',
            ),
            1 => 
            array (
                'foodsaver_id' => 3,
                'bezirk_id' => 4,
                'active' => 1,
                'added' => '2017-08-25 21:52:10',
                'application' => '',
            ),
            2 => 
            array (
                'foodsaver_id' => 4,
                'bezirk_id' => 4,
                'active' => 1,
                'added' => '2017-08-25 22:17:17',
                'application' => '',
            ),
            3 => 
            array (
                'foodsaver_id' => 5,
                'bezirk_id' => 4,
                'active' => 1,
                'added' => '2017-08-25 21:44:00',
                'application' => '',
            ),
            4 => 
            array (
                'foodsaver_id' => 6,
                'bezirk_id' => 4,
                'active' => 1,
                'added' => '2017-08-25 22:11:33',
                'application' => '',
            ),
        ));
        
        
    }
}