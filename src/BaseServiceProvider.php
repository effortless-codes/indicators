<?php

namespace Winata\Core\Indicator;

use Illuminate\Support\ServiceProvider;
use Winata\Core\Indicator\Notify\NotifyConfig;
use Winata\Core\Indicator\Notify\ToNotify;
use Winata\Core\Indicator\Sessions\AlertSessionStore;
use Winata\Core\Indicator\Sessions\SessionStoreInterface;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/winata/indicator.php', 'winata.indicator');

        // Binding required classes to app
        $this->app->bind(
            SessionStoreInterface::class,
            AlertSessionStore::class,
            ToNotify::class,
        );

        // Register the main class to use with the facade
        $this->app->singleton('notify', function ($app) {
            return $this->app->make(NotifyConfig::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/winata/indicator.php' => config_path('winata/indicator.php')], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'indicator');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     * @author Rashid Ali <realrashid05@gmail.com>
     */
    private function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/indicator')
        ], 'indicator-view');

        $this->publishes([
            __DIR__ . '/../resources/js' => public_path('vendor/indicator')
        ], 'indicator-asset');

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('vendor/indicator')
        ], 'indicator-asset');
    }

}
