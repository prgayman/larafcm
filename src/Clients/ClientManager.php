<?php

namespace Prgayman\LaraFcm\Clients;

use GuzzleHttp\Client;
use Illuminate\Support\Manager;

class ClientManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config['larafcm.driver'];
    }

    protected function createHttpDriver()
    {
        $config = $this->config->get('larafcm.http', []);

        return new Client(['timeout' => $config[ 'timeout' ]]);
    }
}
