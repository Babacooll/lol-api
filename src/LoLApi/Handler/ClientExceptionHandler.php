<?php

namespace LoLApi\Handler;

use GuzzleHttp\Exception\ClientException;
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
     * @throws ServiceRateLimitException
     * @throws UserRateLimitException
     */
    public function handleClientException(ClientException $e)
    {
        if ($e->getResponse()->getStatusCode() === 429) {
            $this->handleRateLimitException($e);
        }

        throw $e;
    }

    /**
     * @param ClientException $e
     *
     * @throws ServiceRateLimitException
     * @throws UserRateLimitException
     */
    protected function handleRateLimitException(ClientException $e)
    {
        if ($e->getResponse()->getHeader(self::HEADER_RATE_LIMIT_TYPE) === self::RATE_LIMIT_TYPE_USER) {
            $exception = new UserRateLimitException();
        } else {
            $exception = new ServiceRateLimitException();
        }

        throw $exception
            ->setClientException($e)
            ->setRetryAfter($e->getResponse()->getHeader(self::HEADER_RETRY_AFTER)[0]);
    }
}
