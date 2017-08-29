<?php

namespace Foodsharing\Bootstrap\Commands;

use Illuminate\Console\Command;

class Installation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fs:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will install foodsharing (migration, seeds, publishes)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->line('work in progress, got to /install and use web installer ;)');
        //exit();
        /*
         * Create Database Structure from Migrations
         */

        $this->call('migrate');

        $this->call('db:seed');


        /*
         * minify public assets
         */

        $this->call('fs:minify');

        /*
         * Seed with static Data
         */
        //$this->call('db:seed');

        /*
         * Seed with static Data
         */
        $this->call('translations:export',[
            'group' => '*'
        ]);

        /*
         * comment / route out
         */
        $routes = file_get_contents('./');

        $this->line('');

        $this->line('=======================================');
        $this->info('Foodsharing installation finished!');
        $this->line('=======================================');

        $this->line('add user with: php artisan db:seed --class=DummyDataSeeder');
        $this->line('run Server with: php artisan serv');

        $this->line('=======================================');
    }
}
