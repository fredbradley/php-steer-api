<?php

namespace FredBradley\PhpSteerApi;

class SteerApiServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('steerapi', function (\Illuminate\Contracts\Foundation\Application $app) {
            return new SteerConnector(
                config('steer.api_key'),
                config('steer.sub_id'),
                config('steer.base_url')
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('steer.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'steer');
    }

}
