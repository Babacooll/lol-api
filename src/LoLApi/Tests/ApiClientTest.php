<?php

namespace LoLApi\Tests;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use LoLApi\ApiClient;
use LoLApi\Result\ApiResult;

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
     * @covers LoLApi\ApiClient::getGameApi
     * @covers LoLApi\ApiClient::getStatsApi
     * @covers LoLApi\ApiClient::getCurrentGameApi
     * @covers LoLApi\ApiClient::getTeamApi
     */
    public function testApiGetters()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');

        $this->assertInstanceOf('LoLApi\Api\MatchListApi', $apiClient->getMatchListApi());
        $this->assertInstanceOf('LoLApi\Api\MatchApi', $apiClient->getMatchApi());
        $this->assertInstanceOf('LoLApi\Api\SummonerApi', $apiClient->getSummonerApi());
        $this->assertInstanceOf('LoLApi\Api\ChampionApi', $apiClient->getChampionApi());
        $this->assertInstanceOf('LoLApi\Api\FeaturedGamesApi', $apiClient->getFeaturedGamesApi());
        $this->assertInstanceOf('LoLApi\Api\GameApi', $apiClient->getGameApi());
        $this->assertInstanceOf('LoLApi\Api\StatsApi', $apiClient->getStatsApi());
        $this->assertInstanceOf('LoLApi\Api\CurrentGameApi', $apiClient->getCurrentGameApi());
        $this->assertInstanceOf('LoLApi\Api\TeamApi', $apiClient->getTeamApi());
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
     * @covers LoLApi\ApiClient::setCacheProvider
     * @covers LoLApi\ApiClient::getCacheProvider
     */
    public function testCacheProvider()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');

        $this->assertInstanceOf('Doctrine\Common\Cache\VoidCache', $apiClient->getCacheProvider());

        $apiClient->setCacheProvider(new ArrayCache());

        $this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $apiClient->getCacheProvider());
    }

    /**
     * @covers LoLApi\ApiClient::cacheApiResult
     */
    public function testCacheApiResult()
    {
        $apiResult  = new ApiResult();
        $arrayCache = $this->getMockBuilder('Doctrine\Common\Cache\ArrayCache')->disableOriginalConstructor()->getMock();
        $arrayCache->expects($this->once())->method('save')->willReturn($this->equalTo($apiResult));

        $client = new ApiClient(ApiClient::REGION_EUW, 'test', $arrayCache);

        $client->cacheApiResult($apiResult);
    }

    /**
     * @covers LoLApi\ApiClient::getBaseUrlWithRegion
     */
    public function testGetBaseUrlWithRegion()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');
        $class     = new \ReflectionClass('LoLApi\ApiClient');
        $method    = $class->getMethod('getBaseUrlWithRegion');
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

    /**
     * @covers LoLApi\ApiClient::__construct
     */
    public function testConstructWithClient()
    {
        $httpClient = new Client();
        $apiClient  = new ApiClient(ApiClient::REGION_EUW, 'test', new VoidCache(), $httpClient);

        $this->assertSame($httpClient, $apiClient->getHttpClient());
    }

    /**
     * @covers LoLApi\ApiClient::__construct
     */
    public function testConstruct()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test', new VoidCache());

        $this->assertInstanceOf('GuzzleHttp\Client', $apiClient->getHttpClient());
    }
}