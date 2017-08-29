<?php

use Illuminate\Database\Seeder;

class FsBetriebStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_betrieb_status')->delete();
        
        \DB::table('fs_betrieb_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Es besteht noch kein Kontakt',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Verhandlungen laufen',
            ),
            2 => 
            array (
                'id' => 3,
            'name' => 'Betrieb ist bereit zu spenden :)',
        ),
        3 => 
        array (
            'id' => 4,
            'name' => 'Betrieb will nicht kooperieren',
        ),
        4 => 
        array (
            'id' => 5,
            'name' => 'Betrieb spendet bereits',
        ),
        5 => 
        array (
            'id' => 6,
            'name' => 'spendet an Tafel etc. & wirft nichts weg',
        ),
    ));
        
        
    }
}