<?php

namespace Prgayman\LaraFcm\Request;

use Prgayman\LaraFcm\Message\Data;
use Prgayman\LaraFcm\Message\Notification;
use Prgayman\LaraFcm\Message\Options;
use Prgayman\LaraFcm\Message\Topics;

/**
 * Class Request.
 */
class Request extends BaseRequest
{
    /**
     * @internal
     *
     * @var string|array
     */
    protected $to;

    /**
     * @internal
     *
     * @var Options
     */
    protected ?Options $options = null;

    /**
     * @internal
     *
     * @var Notification
     */
    protected ?Notification $notification = null;

    /**
     * @internal
     *
     * @var Data
     */
    protected ?Data $data = null;

    /**
     * @internal
     *
     * @var Topics|null
     */
    protected ?Topics $topic = null;

    /**
     * Request constructor.
     *
     * @param                     $to
     * @param Options             $options
     * @param Notification        $notification
     * @param Data                $data
     * @param Topics|null         $topic
     */
    public function __construct($to, Options $options = null, Notification $notification = null, Data $data = null, Topics $topic = null)
    {
        parent::__construct();

        $this->to           = $to;
        $this->options      = $options;
        $this->notification = $notification;
        $this->data         = $data;
        $this->topic        = $topic;
    }

    /**
     * Build the body for the request.
     *
     * @return array
     */
    protected function buildBody()
    {
        $message = [
            'to'               => $this->getTo(),
            'registration_ids' => $this->getRegistrationIds(),
            'notification'     => $this->getNotification(),
            'data'             => $this->getData(),
        ];

        $message = array_merge($message, $this->getOptions());

        // remove null entries
        return array_filter($message);
    }

    /**
     * get to key transformed.
     *
     * @return array|null|string
     */
    protected function getTo()
    {
        $to = is_array($this->to) ? null : $this->to;

        if ($this->topic && $this->topic->hasOnlyOneTopic()) {
            $to = $this->topic->build();
        }

        return $to;
    }

    /**
     * get registrationIds transformed.
     *
     * @return array|null
     */
    protected function getRegistrationIds()
    {
        return is_array($this->to) ? $this->to : null;
    }

    /**
     * get Options transformed.
     *
     * @return array
     */
    protected function getOptions() :array
    {
        $options = $this->options ? $this->options->build()->toArray() : [];

        if ($this->topic && !$this->topic->hasOnlyOneTopic()) {
            $options = array_merge($options, $this->topic->build());
        }

        return $options;
    }

    /**
     * get notification transformed.
     *
     * @return array|null
     */
    protected function getNotification()
    {
        return $this->notification ? $this->notification->build()->toArray() : null;
    }

    /**
     * get data transformed.
     *
     * @return array|null
     */
    protected function getData()
    {
        return $this->data ? $this->data->build()->toArray() : null;
    }
}
