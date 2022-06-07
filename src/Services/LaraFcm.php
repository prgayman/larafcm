<?php

namespace Prgayman\LaraFcm\Services;

use Exception;
use Prgayman\LaraFcm\Message\Notification;
use Prgayman\LaraFcm\Message\Data;
use Prgayman\LaraFcm\Message\Options;
use Prgayman\LaraFcm\Message\Topics;

use \Prgayman\LaraFcm\Response\DownstreamResponse;
use \Prgayman\LaraFcm\Response\TopicResponse;

class LaraFcm
{
    /**
     * @internal
     *
     * @var string|array|null
     */
    protected $to = null;
    
    /**
     * Instance of Notification
     *
     * @var Prgayman\LaraFcm\Message\Notification
     */
    private  $notification = null;
    
    /**
     * Instance of Data
     *
     * @var Prgayman\LaraFcm\Message\Data
     */
    private  $data = null;

    /**
     * Instance of options
     *
     * @var Prgayman\LaraFcm\Message\Options
     */
    private  $options = null;
    
    /**
     * Instance of topics
     *
     * @var Prgayman\LaraFcm\Message\Topics
     */
    private $topics = null;
    
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

    /**
     * Set devices token
     * @param array|string $to
     *
     * @return $this
     */
    public function to($to):self
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Send notification
     *
     * @throws Exception
     * @return DownstreamResponse|TopicResponse|null
     */
    public function send()
    {
        if ($this->topics) {
            $response = $this->client()->sendToTopic($this->topics, $this->options, $this->notification, $this->data);
        } else {
            $response = $this->client()->sendTo($this->to, $this->options, $this->notification, $this->data);
        }

        return $response;
    }

    private function client()
    {
        return app('larafcm.client');
    }
}
