<?php
namespace Prgayman\LaraFcm\Request;

use GuzzleHttp\ClientInterface;

/**
 * Class BaseRequest.
 */
abstract class BaseRequest
{
    /**
     * @internal
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @internal
     *
     * @var array
     */
    protected $config;

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        $this->config = app('config')->get('larafcm', []);
    }

    /**
     * Build the header for the request.
     *
     * @return array
     */
    protected function buildRequestHeader() :array
    {
        return [
            'Authorization' => 'key='.$this->config['authentication_key'],
            'Content-Type'  => 'application/json',
            'project_id'    => $this->config['sender_id'],
        ];
    }

    /**
     * Build the body of the request.
     *
     * @return mixed
     */
    abstract protected function buildBody();

    /**
     * Return the request in array form.
     *
     * @return array
     */
    public function build() :array
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'json' => $this->buildBody(),
        ];
    }
}
