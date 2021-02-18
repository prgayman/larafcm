<?php

namespace Prgayman\LaraFcm\Providers;

use Illuminate\Support\ServiceProvider;
use Prgayman\LaraFcm\Services\LaraFcm;

use Illuminate\Notifications\ChannelManager;
use Prgayman\LaraFcm\Channels\LaraFcmChannel;

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
        $app = $this->app;

        $this->app->make(ChannelManager::class)->extend('larafcm', function () use ($app) {
            return $app->make(LaraFcmChannel::class);
        });

        $this->mergeConfigFrom(
            __DIR__. '/../../config/larafcm.php',
            'larafcm'
        );

        $this->app->bind('larafcm', LaraFcm::class);
    }
}
