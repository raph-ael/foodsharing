<?php

namespace Foodsharing\Bootstrap;

use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Foodsharing\Bootstrap\Commands\Minify',
        'Foodsharing\Bootstrap\Commands\Installation',
        'Foodsharing\Bootstrap\Commands\Seed'
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * include routes
         */
        include __DIR__ . '/routes/old_version.php';
        include __DIR__ . '/routes/refactor.php';

        /*
         * Define Migrations
         */
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        /*
         * Publish assets
         */
        $this->publishes([
           // $this->get_platform_dir() . '/img' => public_path('/'),
            $this->get_platform_dir() . '/js' => public_path('/js'),
            $this->get_platform_dir() . '/css' => public_path('/css'),
            $this->get_platform_dir() . '/fonts' => public_path('/fonts'),
            $this->get_platform_dir() . '/robots.txt' => public_path('/robots.txt'),
            $this->get_platform_dir() . '/favicon.ico' => public_path('/favicon.ico'),
            // $this->get_platform_dir() . '/cache' => public_path('/cache'),

        ], 'public');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    private function get_platform_dir()
    {
        return base_path('packages/foodsharing/platform/src');
    }
}
