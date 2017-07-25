<?php

namespace LoLApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use LoLApi\ApiClient;
use LoLApi\Handler\ClientExceptionHandler;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * Class AbstractApiTest
 *
 * @package LoLApi\Test
 */
abstract class AbstractApiTest extends \PHPUnit_Framework_TestCase
{
    const REGION = 'euw';
    const API_KEY = 'apiKey';

    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * Initiate ApiClient
     */
    public function setUp()
    {
        $this->apiClient = $this->getApiClient(new ArrayAdapter(), $this->getSuccessfulHttpClient());
    }

    /**
     * @param AdapterInterface $cache
     * @param Client           $httpClient
     *
     * @return ApiClient
     */
    protected function getApiClient(AdapterInterface $cache, Client $httpClient)
    {
        return new ApiClient(self::REGION, self::API_KEY, $cache, $httpClient);
    }

    /**
     * @return Client
     */
    protected function getSuccessfulHttpClient()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['success'])),
        ]);

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler, 'base_uri' => 'https://' . self::REGION . '.api.pvp.net']);
    }

    /**
     * @return Client
     */
    protected function getRateLimitHttpClient()
    {
        $mock = new MockHandler([
            new Response(
                429,
                [
                    ClientExceptionHandler::HEADER_RATE_LIMIT_TYPE => ClientExceptionHandler::RATE_LIMIT_TYPE_SERVICE,
                    ClientExceptionHandler::HEADER_RETRY_AFTER     => 50
                ],
                json_encode(['failure']
                )
            ),
        ]);

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler, 'base_uri' => 'https://' . self::REGION . '.api.pvp.net']);
    }
}
