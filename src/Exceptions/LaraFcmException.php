<?php

namespace Prgayman\LaraFcm\Exceptions;

use Exception;

class LaraFcmException extends Exception
{
    public static function inValidNotification()
    {
        return new static("Notification is not valid, to send notifiaction must be set notification object from  [Prgayman\LaraFcm\Message\Notification]");
    }

    public static function inValidData()
    {
        return new static("Message is not valid, to send message must be set data object from [Prgayman\LaraFcm\Message\Data]");
    }
}
