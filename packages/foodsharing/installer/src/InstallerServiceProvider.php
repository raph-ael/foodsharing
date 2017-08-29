<?php

namespace Foodsharing\Installer;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Foodsharing\Installer\Middleware\canInstall;

class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
         * config
         */
        $this->mergeConfigFrom(
            __DIR__.'/Config/installer.php', 'installer'
        );

        include __DIR__ . '/routes.php';
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        /*
         * publish assets
         */
        $this->publishes([
            __DIR__.'/assets' => public_path('installer'),
        ], 'public');

        /*
         * views
         */
        $this->loadViewsFrom( __DIR__.'/Views', 'installer');

        /*
         * translations
         */
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'installer');


        $router->middlewareGroup('install', [canInstall::class]);
    }
}
