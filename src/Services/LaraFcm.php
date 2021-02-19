<?php

namespace Prgayman\LaraFcm\Services;

use Prgayman\LaraFcm\Exceptions\LaraFcmException;
use Prgayman\LaraFcm\Message\Notification;
use Prgayman\LaraFcm\Message\Data;
use Prgayman\LaraFcm\Message\Options;
use Prgayman\LaraFcm\Message\Topics;

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
     * @var Prgayman\LaraFcm\Message\Data
     */
    private Data $data;

    /**
     * Instance of options
     *
     * @var Prgayman\LaraFcm\Message\Options
     */
    private Options $options;
    
    /**
     * Instance of topics
     *
     * @var Prgayman\LaraFcm\Message\Topics
     */
    private Topics $topics;
    
    /**
     * Set notification payload
     * @param Prgayman\LaraFcm\Message\Notification $notification
     *
     * @return self
     */
    public function notification(Notification $notification) :self
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
    public function data(Data $data) :self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set options payload
     * @param Prgayman\LaraFcm\Message\Options $options
     *
     * @return self
     */
    public function options(Options $options) :self
    {
        $this->options = $options;
        return $this;
    }
    
    /**
     * Set topics
     * @param Prgayman\LaraFcm\Message\Topics $topics
     *
     * @return self
     */
    public function topics(Topics $topics) :self
    {
        $this->topics = $topics;
        return $this;
    }

    public function sendNotify()
    {
        if (!isset($this->notification)) {
            throw LaraFcmException::inValidNotification();
        }
        $this->send();
    }

    public function sendMessage()
    {
        if (!isset($this->date)) {
            throw LaraFcmException::inValidData();
        }
        $this->send();
    }

    public function sendNotifyWithMessage()
    {
        $this->send();
    }

    private function send()
    {
    }
}
