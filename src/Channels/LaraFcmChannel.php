<?php

namespace Prgayman\LaraFcm\Channels;

use Illuminate\Notifications\Notification;

class LaraFcmChannel
{
    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var \Prgayman\LaraFcm\Services\LaraFcm $response */
        $response = $notification->toLaraFcm($notifiable);
    }
}
