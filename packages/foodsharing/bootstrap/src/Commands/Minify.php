<?php

namespace Foodsharing\Bootstrap\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Minify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fs:minify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'minifies js and css files';

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

        /*
         * call old minify script and minify files in old directory
         */
        $this->line('minify css and js files...');
        chdir($this->get_platform_dir() .
            '/lib' . DIRECTORY_SEPARATOR . 'minify'
        );
        $output = shell_exec('./min.php');
        $this->info('minified!');


        /*
         * publish old minified js and css files
         */
        $this->line('publish minified files...');
        Artisan::call('vendor:publish', [
            '--force' => true,
            '--tag' => 'public'
        ]);
        $this->info('success!');
    }

    private function get_platform_dir()
    {
        return base_path('packages/foodsharing/platform/src');
    }
}
