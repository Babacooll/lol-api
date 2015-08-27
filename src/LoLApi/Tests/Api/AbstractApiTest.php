<?php

namespace LoLApi\Tests;

use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use LoLApi\ApiClient;

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
        $mock = new MockHandler([
            new Response(200, [], json_encode(['success'])),
        ]);

        $handler    = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handler, 'base_uri' => 'https://' . self::REGION . '.api.pvp.net']);

        $this->apiClient = new ApiClient(self::REGION, self::API_KEY, new VoidCache(), $httpClient);
    }
}
