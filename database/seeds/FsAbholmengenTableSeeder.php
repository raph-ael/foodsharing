<?php

use Illuminate\Database\Seeder;

class FsAbholmengenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('fs_abholmengen')->delete();
        
        \DB::table('fs_abholmengen')->insert(array (
            0 => 
            array (
                'id' => 0,
                'menge' => '1.5',
            ),
            1 => 
            array (
                'id' => 1,
                'menge' => '2.0',
            ),
            2 => 
            array (
                'id' => 2,
                'menge' => '4.0',
            ),
            3 => 
            array (
                'id' => 3,
                'menge' => '7.5',
            ),
            4 => 
            array (
                'id' => 4,
                'menge' => '15.0',
            ),
            5 => 
            array (
                'id' => 5,
                'menge' => '25.0',
            ),
            6 => 
            array (
                'id' => 6,
                'menge' => '45.0',
            ),
            7 => 
            array (
                'id' => 7,
                'menge' => '64.0',
            ),
        ));
        
        
    }
}