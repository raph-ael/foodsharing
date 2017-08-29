<?php

use Illuminate\Database\Seeder;

class FsBotschafterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_botschafter')->delete();
        
        \DB::table('fs_botschafter')->insert(array (
            0 => 
            array (
                'foodsaver_id' => 4,
                'bezirk_id' => 4,
            ),
        ));
        
        
    }
}