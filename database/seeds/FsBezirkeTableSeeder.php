<?php


use Illuminate\Database\Seeder;

class FsBezirkeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $this->seedBezirke();
    }

    private function seedBezirke()
    {
        /*
        DB::listen(function ($query) {

            print_r($query->sql);
            print_r($query->bindings);

        });
        */

        DB::statement('
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"
        ');

        /*
         * SEED AREA (BEZIRK)
         */
        DB::table('fs_bezirk')->insert([
            'id' => 0,
            'parent_id' => null,
            'name' => '',
            'has_children' => 1,
            'type' => 0,
            'teaser' => 'Root',
            'desc' => 'Root'
        ]);

        // @todo find a way to put id 0 to DB Eloquent dont like it... :o/
        //DB::statement('UPDATE `fs_bezirk` SET `id` = \'0\' WHERE `fs_bezirk`.`id` = 1');
        //DB::statement('ALTER `fs_bezirk` AUTO_INCREMENT = 1');

        $area_id_europe = DB::table('fs_bezirk')->insertGetId([
            'parent_id' => 0,
            'name' => 'Europe',
            'has_children' => 1,
            'type' => 6,
            'teaser' => 'Foodsharing Europa',
            'desc' => 'Europa'
        ]);

        $area_id_de = DB::table('fs_bezirk')->insertGetId([
            'parent_id' => 1,
            'name' => 'Deutschland',
            'has_children' => 1,
            'type' => 6,
            'teaser' => 'Foodsharing Deutschland',
            'desc' => 'Deutschland'
        ]);

        $area_id_koeln = DB::table('fs_bezirk')->insertGetId([
            'parent_id' => 2,
            'name' => 'Köln',
            'has_children' => 1,
            'type' => 8,
            'teaser' => 'Foodsharing Köln',
            'desc' => 'Köln'
        ]);

        $area_id_zollstock = DB::table('fs_bezirk')->insertGetId([
            'parent_id' => 3,
            'name' => 'Zollstock',
            'has_children' => 0,
            'type' => 1,
            'teaser' => 'Foodsharing Zollstock',
            'desc' => 'Zollstock'
        ]);



        //1,741,1,6,'',''
    }
}