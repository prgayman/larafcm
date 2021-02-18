<?php

namespace Prgayman\LaraFcm\Facades;

use Illuminate\Support\Facades\Facade;

/**
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
