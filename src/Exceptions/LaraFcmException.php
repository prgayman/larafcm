<?php

namespace Prgayman\LaraFcm\Exceptions;

use Exception;

class LaraFcmException extends Exception
{
    public static function inValidNotification()
    {
        return new static("Notification object not valid, to send notifiaction must be set notification object from  [Prgayman\LaraFcm\Message\Notification]");
    }

    public static function inValidData()
    {
        return new static("Message object not valid, to send message must be set data object from  [Prgayman\LaraFcm\Message\Data]");
    }
}
