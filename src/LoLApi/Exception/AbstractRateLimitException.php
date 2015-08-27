<?php

namespace LoLApi\Exception;

use GuzzleHttp\Exception\ClientException;

/**
 * Class RateLimitException
 *
 * @package LoLApi\Exception
 */
abstract class AbstractRateLimitException extends \Exception
{
    /** @var string */
    protected $retryAfter;

    /** @var ClientException */
    protected $clientException;

    /**
     * @return string
     */
    public function getRetryAfter()
    {
        return $this->retryAfter;
    }

    /**
     * @param string $retryAfter
     *
     * @return $this
     */
    public function setRetryAfter($retryAfter)
    {
        $this->retryAfter = $retryAfter;

        return $this;
    }

    /**
     * @return ClientException
     */
    public function getClientException()
    {
        return $this->clientException;
    }

    /**
     * @param ClientException $clientException
     *
     * @return $this
     */
    public function setClientException(ClientException $clientException)
    {
        $this->clientException = $clientException;

        return $this;
    }
}
