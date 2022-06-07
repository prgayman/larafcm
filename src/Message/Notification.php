<?php

namespace Prgayman\LaraFcm\Message;

class Notification
{
    /**
     * @internal
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $body = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $icon = null;

    /**
     * @internal
     *
     * @var string
     */
    protected  $sound = "default";

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $channelId = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $badge = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $tag = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $color = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $clickAction = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationKey = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationArgs = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $titleLocationKey = null;

    /**
     * @internal
     *
     * @var null|string
     */
    protected  $titleLocationArgs = null;

    /**
     * Indicates notification title. This field is not visible on iOS phones and tablets.
     * but it is required for android.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title) :self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Indicates notification body text.
     *
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body) :self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Set a channel ID for android API >= 26.
     *
     * @param string $channelId
     *
     * @return $this
     */
    public function setChannelId(string $channelId) :self
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Supported Android
     * Indicates notification icon. example : Sets value to myicon for drawable resource myicon.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon) :self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Indicates a sound to play when the device receives a notification.
     * Supports default or the filename of a sound resource bundled in the app.
     *
     * @param string $sound
     *
     * @return $this
     */
    public function setSound(string $sound) :self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * Supported Ios.
     *
     * Indicates the badge on the client app home icon.
     *
     * @param string $badge
     *
     * @return $this
     */
    public function setBadge(string $badge) :self
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Supported Android.
     *
     * Indicates whether each notification results in a new entry in the notification drawer on Android.
     * If not set, each request creates a new notification.
     * If set, and a notification with the same tag is already being shown, the new notification replaces the existing one in the notification drawer.
     *
     * @param string $tag
     *
     * @return $this
     */
    public function setTag(string $tag) :self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Supported Android.
     *
     * Indicates color of the icon, expressed in #rrggbb format
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color) :self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Indicates the action associated with a user click on the notification.
     *
     * @param string $action
     *
     * @return $this
     */
    public function setClickAction(string $action) :self
    {
        $this->clickAction = $action;

        return $this;
    }

    /**
     * Indicates the key to the title string for localization.
     *
     * @param string $titleKey
     *
     * @return $this
     */
    public function setTitleLocationKey(string $titleKey) :self
    {
        $this->titleLocationKey = $titleKey;

        return $this;
    }

    /**
     * Indicates the string value to replace format specifiers in the title string for localization.
     *
     * @param mixed $titleArgs
     *
     * @return $this
     */
    public function setTitleLocationArgs(string $titleArgs) :self
    {
        $this->titleLocationArgs = $titleArgs;

        return $this;
    }

    /**
     * Indicates the key to the body string for localization.
     *
     * @param string $bodyKey
     *
     * @return $this
     */
    public function setBodyLocationKey(string $bodyKey) :self
    {
        $this->bodyLocationKey = $bodyKey;

        return $this;
    }

    /**
     * Indicates the string value to replace format specifiers in the body string for localization.
     *
     * @param mixed $bodyArgs
     *
     * @return $this
     */
    public function setBodyLocationArgs(string $bodyArgs) :self
    {
        $this->bodyLocationArgs = $bodyArgs;

        return $this;
    }

    /**
     * Get title.
     *
     * @return null|string
     */
    public function getTitle() :?string
    {
        return $this->title;
    }

    /**
     * Get body.
     *
     * @return null|string
     */
    public function getBody() :?string
    {
        return $this->body;
    }

    /**
     * Get channel id for android api >= 26
     *
     * @return null|string
     */
    public function getChannelId() :?string
    {
        return $this->channelId;
    }

    /**
     * Get Icon.
     *
     * @return null|string
     */
    public function getIcon() :?string
    {
        return $this->icon;
    }

    /**
     * Get Sound.
     *
     * @return string
     */
    public function getSound() :string
    {
        return $this->sound;
    }

    /**
     * Get Badge.
     *
     * @return null|string
     */
    public function getBadge() :?string
    {
        return $this->badge;
    }

    /**
     * Get Tag.
     *
     * @return null|string
     */
    public function getTag() :?string
    {
        return $this->tag;
    }

    /**
     * Get Color.
     *
     * @return null|string
     */
    public function getColor() :?string
    {
        return $this->color;
    }

    /**
     * Get ClickAction.
     *
     * @return null|string
     */
    public function getClickAction() :?string
    {
        return $this->clickAction;
    }

    /**
     * Get BodyLocationKey.
     *
     * @return null|string
     */
    public function getBodyLocationKey() :?string
    {
        return $this->bodyLocationKey;
    }

    /**
     * Get BodyLocationArgs.
     *
     * @return null|string|array
     */
    public function getBodyLocationArgs() :?string
    {
        return $this->bodyLocationArgs;
    }
 
    /**
     * Get TitleLocationKey.
     *
     * @return string
     */
    public function getTitleLocationKey() :?string
    {
        return $this->titleLocationKey;
    }

    /**
     * GetTitleLocationArgs.
     *
     * @return null|string|array
     */
    public function getTitleLocationArgs() :?string
    {
        return $this->titleLocationArgs;
    }

    /**
     * Build Payload Notification
     */
    public function build() :NotificationBuild
    {
        return new NotificationBuild($this);
    }
}
