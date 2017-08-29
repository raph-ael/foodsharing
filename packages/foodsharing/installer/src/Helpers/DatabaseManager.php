<?php

namespace Foodsharing\Installer\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{

    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public function migrateAndSeed()
    {
        $this->sqlite();
        return $this->migrate();
    }

    /**
     * Run the migration and call the seeder.
     *
     * @return array
     */
    private function migrate()
    {
        Artisan::call('migrate', ["--force"=> true ]);
        try{

        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }

        return $this->seed();
    }

    /**
     * Seeds the dummy Data
     *
     * @return array
     */
    public function seedDummyData()
    {
        Artisan::call('db:seed', ['--class' => 'DummyDataSeeder' ]);
        try{
            /*
             * seed dummy data
             */

        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }


    }



    /**
     * Seed the database.
     *
     * @return array
     */
    private function seed()
    {
        Artisan::call('db:seed');

        try{
            /*
             * seed static data
             */


        }
        catch(Exception $e){
            //return $this->response($e->getMessage());
        }

        try{
            /*
             * install translations
             */
            Artisan::call('translations:export', ['group' => '*' ]);

        }
        catch(Exception $e){
            //return $this->response($e->getMessage());
        }

        return $this->response(trans('installer::installer_messages.final.finished'), 'success');
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param string $status
     * @return array
     */
    private function response($message, $status = 'danger')
    {
        return array(
            'status' => $status,
            'message' => $message
        );
    }
    
        /**
     * check database type. If SQLite, then create the database file.
     */
    private function sqlite()
    {
        if(DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if(!file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
        }
    }
}
