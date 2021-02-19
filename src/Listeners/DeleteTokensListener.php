<?php

namespace Prgayman\LaraFcm\Listeners;

use Prgayman\LaraFcm\Events\SentNotificationEvent;
use Prgayman\LaraFcm\Response\DownstreamResponse;
use Prgayman\LaraFcm\Services\LaraFcmToken;

class DeleteTokensListener
{
 
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SentNotificationEvent $event)
    {
        $response = $event->response;
        if ($response instanceof DownstreamResponse) {
            $tokensToDelete = $response->tokensToDelete();
            if (count($tokensToDelete)>0) {
                LaraFcmToken::removeDbTokens($tokensToDelete);
            }
        }
    }
}
