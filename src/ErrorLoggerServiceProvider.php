<?php

namespace ErrorLogger;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ErrorLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/errorlogger.php', 'errorlogger');

        $this->app->singleton(ErrorLogger::SERVICE, function ($app) {
            return new ErrorLogger;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (function_exists('config_path')) {
            /*
             * Publish configuration file
             */
            $this->publishes([
                __DIR__ . '/../config/errorlogger.php' => config_path('errorlogger.php'),
            ]);
        }
    }
}
