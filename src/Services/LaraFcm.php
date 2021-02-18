<?php

namespace Prgayman\LaraFcm\Services;

use Prgayman\LaraFcm\Message\Notification;
use Prgayman\LaraFcm\Message\Data;

class LaraFcm
{
    /**
     * Instance of Notification
     *
     * @var Prgayman\LaraFcm\Message\Notification
     */
    private Notification $notification;
    
    /**
     * Instance of Data
     *
     * @var Prgayman\LaraFcm\Message\Data\Data
     */
    private Data $data;

    /**
     * Set notification payload
     * @param Prgayman\LaraFcm\Message\Notification $notification
     *
     * @return self
     */
    public function setNotification(Notification $notification) :self
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * Set data payload
     * @param Prgayman\LaraFcm\Message\Data $data
     *
     * @return self
     */
    public function setData(Data $data) :self
    {
        $this->data = $data;
        return $this;
    }

    public function send()
    {
    }
}
