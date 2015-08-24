<?php

namespace LoLApi\Tests;

use LoLApi\ApiClient;

/**
 * Class ApiClientTest
 *
 * @package LoLApi\Tests
 */
class ApiClientTest extends \PHPUnit_Framework_TestCase
{
    const REGION = 'euw';
    const API_KEY = 'test';

    /**
     * @covers LoLApi\ApiClient::getMatchListApi
     * @covers LoLApi\ApiClient::getMatchApi
     * @covers LoLApi\ApiClient::getSummonerApi
     * @covers LoLApi\ApiClient::getChampionApi
     * @covers LoLApi\ApiClient::getFeaturedGamesApi
     */
    public function testApiGetters()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');

        $this->assertInstanceOf('LoLApi\Api\MatchListApi', $apiClient->getMatchListApi());
        $this->assertInstanceOf('LoLApi\Api\MatchApi', $apiClient->getMatchApi());
        $this->assertInstanceOf('LoLApi\Api\SummonerApi', $apiClient->getSummonerApi());
        $this->assertInstanceOf('LoLApi\Api\ChampionApi', $apiClient->getChampionApi());
        $this->assertInstanceOf('LoLApi\Api\FeaturedGamesApi', $apiClient->getFeaturedGamesApi());
    }

    /**
     * @covers LoLApi\ApiClient::getRegion
     * @covers LoLApi\ApiClient::getApiKey
     * @covers LoLApi\ApiClient::getHttpClient
     */
    public function testOtherGetters()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');

        $this->assertEquals(self::REGION, $apiClient->getRegion());
        $this->assertEquals(self::API_KEY, $apiClient->getApiKey());
        $this->assertInstanceOf('GuzzleHttp\Client', $apiClient->getHttpClient());
    }

    /**
     * @covers LoLApi\ApiClient::getBaseUrlWithRegion
     */
    public function testGetBaseUrlWithRegion()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');
        $class = new \ReflectionClass('LoLApi\ApiClient');
        $method = $class->getMethod('getBaseUrlWithRegion');
        $method->setAccessible(true);

        $this->assertEquals('https://euw.api.pvp.net', $method->invoke($apiClient));
    }

    /**
     * @covers LoLApi\ApiClient::__construct
     */
    public function testInvalidRegion()
    {
        $this->setExpectedException('\Exception');

        new ApiClient('test', 'test');
    }
}
