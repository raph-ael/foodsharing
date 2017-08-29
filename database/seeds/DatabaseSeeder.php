<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 600);

        Model::unguard();

        $this->truncateMultiple(['sessions']);

        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);

        
        /*
         * Seed Bezirke Table
         */
        $this->call(FsBezirkeTableSeeder::class);


        /*
         * Seet Content Table
         */
        $this->call(FsContentTableSeeder::class);

        /*
         * seed quiz
         */
        $this->call(FsQuizTableSeeder::class);
        $this->call(FsQuestionTableSeeder::class);
        $this->call(FsAnswerTableSeeder::class);
        $this->call(FsQuestionHasQuizTableSeeder::class);

        /*
         * seed static data
         */
        $this->call(FsAbholmengenTableSeeder::class);
        $this->call(FsBetriebKategorieTableSeeder::class);
        $this->call(FsBetriebStatusTableSeeder::class);
        $this->call(FsKetteTableSeeder::class);
        $this->call(FsLebensmittelTableSeeder::class);

        /*
         * seed faqs
         */
        $this->call(FsFaqTableSeeder::class);
        $this->call(FsFaqCategoryTableSeeder::class);

        /*
         * seed email message templates
         */
        $this->call(FsMessageTplTableSeeder::class);


        $this->call(TranslationsTableSeeder::class);

        Model::reguard();
        //$this->call(RolesTableSeeder::class);
    }
}
