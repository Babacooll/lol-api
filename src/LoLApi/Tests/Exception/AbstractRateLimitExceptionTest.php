<?php

namespace LoLApi\Tests\Exception;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use LoLApi\Exception\ServiceRateLimitException;

/**
 * Class AbstractRateLimitExceptionTest
 *
 * @package LoLApi\Tests\Exception
 */
class AbstractRateLimitExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers LoLApi\Exception\ServiceRateLimitException::getClientException
     * @covers LoLApi\Exception\ServiceRateLimitException::setClientException
     */
    public function testClientException()
    {
        $response                  = new Response(400);
        $request                   = new Request('GET', 'test');
        $clientException           = new ClientException('test', $request, $response);
        $serviceRateLimitException = new ServiceRateLimitException();

        $this->assertEquals($serviceRateLimitException, $serviceRateLimitException->setClientException($clientException));
        $this->assertEquals($clientException, $serviceRateLimitException->getClientException());
    }

    /**
     * @covers LoLApi\Exception\ServiceRateLimitException::setRetryAfter
     * @covers LoLApi\Exception\ServiceRateLimitException::getRetryAfter
     */
    public function testRetryAfter()
    {
        $serviceRateLimitException = new ServiceRateLimitException();
        $retryAfter                = 10;

        $this->assertSame($serviceRateLimitException, $serviceRateLimitException->setRetryAfter($retryAfter));
        $this->assertSame($retryAfter, $serviceRateLimitException->getRetryAfter());
    }
}
