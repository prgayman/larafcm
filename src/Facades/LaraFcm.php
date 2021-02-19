<?php

namespace Prgayman\LaraFcm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Prgayman\LaraFcm\Services\LaraFcm notification(Prgayman\LaraFcm\Message\Notification $notification)
 * @method static \Prgayman\LaraFcm\Services\LaraFcm data(Prgayman\LaraFcm\Message\Data $data)
 * @method static \Prgayman\LaraFcm\Services\LaraFcm options(Prgayman\LaraFcm\Message\Options $options)
 * @method static \Prgayman\LaraFcm\Services\LaraFcm topics(Prgayman\LaraFcm\Message\Topics $topics)
 * @method static \Prgayman\LaraFcm\Services\LaraFcm to(array|string $to)
 * @method static \Prgayman\LaraFcm\Response\DownstreamResponse|\Prgayman\LaraFcm\Response\TopicResponse|null send()
 *
 * @see \Prgayman\LaraFcm\Services\LaraFcm
 */

class LaraFcm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'larafcm';
    }
}
