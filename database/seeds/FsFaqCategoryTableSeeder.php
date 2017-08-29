<?php

use Illuminate\Database\Seeder;

class FsFaqCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_faq_category')->delete();
        
        \DB::table('fs_faq_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Öffentlich',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Intern',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Beides',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Foodsaver',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'BotschafterInnen',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Unternehmen',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Tips',
            ),
        ));
        
        
    }
}