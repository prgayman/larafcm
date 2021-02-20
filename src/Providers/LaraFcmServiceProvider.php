<?php

namespace Prgayman\LaraFcm\Providers;

use Illuminate\Support\ServiceProvider;
use Prgayman\LaraFcm\Services\LaraFcm;

use Illuminate\Notifications\ChannelManager;
use Prgayman\LaraFcm\Channels\LaraFcmChannel;
use Prgayman\LaraFcm\Clients\ClientManager;
use Prgayman\LaraFcm\Clients\FcmClient;
use Illuminate\Support\Str;

class LaraFcmServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/larafcm.php' => config_path('larafcm.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../Database/migrations/2021_02_18_160600_create_larafcm_tokens_table.php' => database_path('2021_02_18_160600_create_larafcm_tokens_table.php'),
        ], 'migrations');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->app->register(EventServiceProvider::class);
    }

    public function register()
    {
        $app = $this->app;

        if (!Str::contains($this->app->version(), 'Lumen')) {
            $this->mergeConfigFrom(
                __DIR__. '/../../config/larafcm.php',
                'larafcm'
            );
        }

        $this->app->make(ChannelManager::class)->extend('larafcm', function () use ($app) {
            return $app->make(LaraFcmChannel::class);
        });



        $this->app->bind('larafcm', LaraFcm::class);

        $this->app->singleton('larafcm.http.client', function ($app) {
            return (new ClientManager($app))->driver();
        });

        $this->app->bind('larafcm.client', function ($app) {
            return new FcmClient($app['larafcm.http.client'], $app['config']->get('larafcm.http.server_send_url'));
        });
    }
}
