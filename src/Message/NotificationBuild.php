<?php
namespace Prgayman\LaraFcm\Message;

use Illuminate\Contracts\Support\Arrayable;

class NotificationBuild implements Arrayable
{
    private Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function toArray()
    {
        $notification = [
            'title'              => $this->notification->getTitle(),
            'body'               => $this->notification->getBody(),
            'android_channel_id' => $this->notification->getChannelId(),
            'icon'               => $this->notification->getIcon(),
            'sound'              => $this->notification->getSound(),
            'badge'              => $this->notification->getBadge(),
            'tag'                => $this->notification->getTag(),
            'color'              => $this->notification->getColor(),
            'click_action'       => $this->notification->getClickAction(),
            'body_loc_key'       => $this->notification->getBodyLocationKey(),
            'body_loc_args'      => $this->notification->getBodyLocationArgs(),
            'title_loc_key'      => $this->notification->getTitleLocationKey(),
            'title_loc_args'     => $this->notification->getTitleLocationArgs(),
        ];

        // remove all null values
        $notification = array_filter($notification, function ($value) {
            return $value !== null;
        });
        
        return $notification;
    }
}
