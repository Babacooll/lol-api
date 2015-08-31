<?php

namespace LoLApi\Tests\Handler;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use LoLApi\Handler\ClientExceptionHandler;

/**
 * Class ClientExceptionHandlerTest
 *
 * @package LoLApi\Tests\Handler
 */
class ClientExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param ClientException $clientException
     *
     * @covers LoLApi\Handler\ClientExceptionHandler::handleClientException
     *
     * @dataProvider getClientException
     */
    public function testHandleClientExceptionWithoutRateLimit(ClientException $clientException)
    {
        $this->assertSame($clientException, (new ClientExceptionHandler())->handleClientException($clientException));
    }

    /**
     * @param string $headerRateLimit
     * @param string $exceptionNamespace
     *
     * @covers       LoLApi\Handler\ClientExceptionHandler::handleClientException
     * @covers       LoLApi\Handler\ClientExceptionHandler::handleRateLimitException
     *
     * @dataProvider dataProvider
     */
    public function testHandleClientExceptionWithRateLimit($headerRateLimit, $exceptionNamespace)
    {
        $response = new Response(
            429,
            [
                ClientExceptionHandler::HEADER_RATE_LIMIT_TYPE => $headerRateLimit,
                ClientExceptionHandler::HEADER_RETRY_AFTER     => 10
            ]
        );

        $clientException        = new ClientException('test', new Request('GET', 'test'), $response);
        $clientExceptionHandler = new ClientExceptionHandler();

        $this->assertInstanceOf($exceptionNamespace, $clientExceptionHandler->handleClientException($clientException));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                ClientExceptionHandler::RATE_LIMIT_TYPE_USER,
                'LoLApi\Exception\UserRateLimitException'
            ],
            [
                ClientExceptionHandler::RATE_LIMIT_TYPE_SERVICE,
                'LoLApi\Exception\ServiceRateLimitException'
            ]
        ];
    }

    /**
     * @return array
     */
    public function getClientException()
    {
        return [
            [
                new ClientException('exception', new Request('POST', 'data'), new Response(400))
            ]
        ];
    }
}
