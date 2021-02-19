<?php

namespace Prgayman\LaraFcm\Clients;

use Prgayman\LaraFcm\Message\Data;
use Prgayman\LaraFcm\Message\Notification;
use Prgayman\LaraFcm\Message\Options;
use Prgayman\LaraFcm\Message\Topics;
use Prgayman\LaraFcm\Request\Request;
use Prgayman\LaraFcm\Response\DownstreamResponse;
use Prgayman\LaraFcm\Response\TopicResponse;
use GuzzleHttp\Exception\ClientException;
use Prgayman\LaraFcm\Events\SentNotificationEvent;

class FcmClient extends HttpClient
{
    const MAX_TOKEN_PER_REQUEST = 1000;

    /**
     * send a downstream message to.
     *
     * - a unique device with is registration Token
     * - or to multiples devices with an array of registrationIds
     *
     * @param string|array      $to
     * @param Options|null      $options
     * @param Notification|null $notification
     * @param Data|null         $data
     *
     * @return DownstreamResponse|null
     */
    public function sendTo($to, Options $options = null, Notification $notification = null, Data $data = null)
    {
        $response = null;

        if (is_array($to) && !empty($to)) {
            $partialTokens = array_chunk($to, self::MAX_TOKEN_PER_REQUEST, false);
            foreach ($partialTokens as $tokens) {
                $request = new Request($tokens, $options, $notification, $data);

                $responseGuzzle = $this->post($request);

                $responsePartial = new DownstreamResponse($responseGuzzle, $tokens);
                if (!$response) {
                    $response = $responsePartial;
                } else {
                    $response->merge($responsePartial);
                }
            }
        } else {
            $request = new Request($to, $options, $notification, $data);
            $responseGuzzle = $this->post($request);

            $response = new DownstreamResponse($responseGuzzle, $to);
        }

        event(new SentNotificationEvent($response));
        return $response;
    }

    /**
     * Send message devices registered at a or more topics.
     *
     * @param Topics            $topics
     * @param Options|null      $options
     * @param Notification|null $notification
     * @param Data|null         $data
     *
     * @return TopicResponse
     */
    public function sendToTopic(Topics $topics, Options $options = null, Notification $notification = null, Data $data = null)
    {
        $request = new Request(null, $options, $notification, $data, $topics);

        $responseGuzzle = $this->post($request);

        return new TopicResponse($responseGuzzle, $topics);
    }

    /**
     * @internal
     *
     * @param \LaravelFCM\Request\Request $request
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    protected function post($request)
    {
        try {
            $responseGuzzle = $this->client->request('post', $this->url, $request->build());
        } catch (ClientException $e) {
            $responseGuzzle = $e->getResponse();
        }

        return $responseGuzzle;
    }
}
