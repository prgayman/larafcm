<?php

namespace Prgayman\LaraFcm\Message;

use Illuminate\Contracts\Support\Arrayable;

class OptionsBuild implements Arrayable
{
    /**
     * @internal
     *
     * @var Options
     */
    protected $options;

    /**
     * Options constructor.
     *
     * @param Options $options
     */
    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    /**
     * Transform Option to array.
     *
     * @return array
     */
    public function toArray()
    {
        $contentAvailable = $this->options->isContentAvailable() ? true : null;
        $mutableContent = $this->options->isMutableContent() ? true : null;
        $delayWhileIdle = $this->options->isDelayWhileIdle() ? true : null;
        $dryRun = $this->options->isDryRun() ? true : null;

        $options = [
            'collapse_key'             => $this->options->getCollapseKey(),
            'priority'                 => $this->options->getPriority(),
            'content_available'        => $contentAvailable,
            'mutable_content'          => $mutableContent,
            'delay_while_idle'         => $delayWhileIdle,
            'time_to_live'             => $this->options->getTimeToLive(),
            'restricted_package_name'  => $this->options->getRestrictedPackageName(),
            'dry_run'                  => $dryRun,
        ];

        return array_filter($options);
    }
}
