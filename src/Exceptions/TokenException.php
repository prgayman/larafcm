<?php

namespace Prgayman\LaraFcm\Exceptions;

use Exception;

class TokenException extends Exception
{
    public static function modelInValid()
    {
        return new static("Model is not valid must be object of [Illuminate\Database\Eloquent\Model]");
    }
}
