<?php

use Illuminate\Database\Seeder;

class FsLebensmittelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_lebensmittel')->delete();
        
        \DB::table('fs_lebensmittel')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Backwaren',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Trockenware',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kosmetik',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Hygieneartikel',
            ),
            4 => 
            array (
                'id' => 5,
            'name' => 'Molkereiprodukte (MoPro) gekühlt!',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Zubereitete kalte Speisen',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Zubereitete warme Speisen',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Obst & Gemüse',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Tiefkühlware',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Zubereitete Getränke',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Getränke',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Tierfutter',
            ),
        ));
        
        
    }
}