<?php

namespace LoLApi\Handler;

use GuzzleHttp\Exception\ClientException;
use LoLApi\Exception\AbstractRateLimitException;
use LoLApi\Exception\ServiceRateLimitException;
use LoLApi\Exception\UserRateLimitException;

/**
 * Class ClientExceptionHandler
 *
 * @package LoLApi\Handler
 */
class ClientExceptionHandler
{
    const HEADER_RATE_LIMIT_TYPE = 'X-Rate-Limit-Type';
    const HEADER_RETRY_AFTER = 'Retry-After';
    const RATE_LIMIT_TYPE_USER = 'user';
    const RATE_LIMIT_TYPE_SERVICE = 'service';

    /**
     * @param ClientException $e
     *
     * @return ClientException|AbstractRateLimitException
     */
    public function handleClientException(ClientException $e)
    {
        if ($e->getResponse()->getStatusCode() === 429) {
            return $this->handleRateLimitException($e);
        }

        return $e;
    }

    /**
     * @param ClientException $e
     *
     * @return AbstractRateLimitException
     */
    protected function handleRateLimitException(ClientException $e)
    {
        if ($e->getResponse()->getHeader(self::HEADER_RATE_LIMIT_TYPE)[0] === self::RATE_LIMIT_TYPE_USER) {
            $exception = new UserRateLimitException();
        } else {
            $exception = new ServiceRateLimitException();
        }

        return $exception
            ->setClientException($e)
            ->setRetryAfter($e->getResponse()->getHeader(self::HEADER_RETRY_AFTER)[0]);
    }
}
