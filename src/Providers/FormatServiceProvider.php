<?php

namespace S4mpp\Format\Providers;

use S4mpp\Format\Format;
use Illuminate\Support\ServiceProvider;

class FormatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('format', fn() => new Format);
    }
}
