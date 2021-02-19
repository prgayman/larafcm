<?php

namespace Prgayman\LaraFcm\Events;

use Illuminate\Queue\SerializesModels;

class SentNotificationEvent
{
    use  SerializesModels;

    public $response;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($response)
    {
        $this->response = $response;
    }
}
