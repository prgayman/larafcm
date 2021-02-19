<?php
namespace Prgayman\LaraFcm\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Class UnauthorizedRequestException.
 */
class UnauthorizedRequestException extends Exception
{
    /**
     * UnauthorizedRequestException constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $code = $response->getStatusCode();

        parent::__construct('LARAFCM_SENDER_ID or LARAFCM_AUTHENTICATION_KEY are invalid', $code);
    }
}
