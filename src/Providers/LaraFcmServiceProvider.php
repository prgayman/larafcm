<?php

namespace Prgayman\LaraFcm\Providers;

use Illuminate\Support\ServiceProvider;
use Prgayman\LaraFcm\Services\LaraFcm;
use Prgayman\LaraFcm\Services\LaraFcmToken;

class LaraFcmServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/larafcm.php' => config_path('larafcm.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__. '/../../config/larafcm.php',
            'larafcm'
        );

        $this->app->bind('larafcm', LaraFcm::class);
    }
}
