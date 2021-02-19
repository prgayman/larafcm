<?php

namespace Prgayman\LaraFcm\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Prgayman\LaraFcm\Events\SentNotificationEvent::class => [
            \Prgayman\LaraFcm\Listeners\DeleteTokensListener::class
        ]
    ];
}
