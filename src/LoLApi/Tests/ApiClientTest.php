<?php

namespace LoLApi\Tests;

use GuzzleHttp\Client;
use LoLApi\ApiClient;
use LoLApi\Result\ApiResult;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\NullAdapter;

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
     * @covers LoLApi\ApiClient::getMatchApi
     * @covers LoLApi\ApiClient::getSummonerApi
     * @covers LoLApi\ApiClient::getChampionApi
     * @covers LoLApi\ApiClient::getFeaturedGamesApi
     * @covers LoLApi\ApiClient::getSpectatorApi
     * @covers LoLApi\ApiClient::getStaticDataApi
     * @covers LoLApi\ApiClient::getLeagueApi
     * @covers LoLApi\ApiClient::getStatusApi
     * @covers LoLApi\ApiClient::getChampionMasteryApi
     */
    public function testApiGetters()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test');

        $this->assertInstanceOf('LoLApi\Api\MatchApi', $apiClient->getMatchApi());
        $this->assertInstanceOf('LoLApi\Api\SummonerApi', $apiClient->getSummonerApi());
        $this->assertInstanceOf('LoLApi\Api\ChampionApi', $apiClient->getChampionApi());
        $this->assertInstanceOf('LoLApi\Api\SpectatorApi', $apiClient->getSpectatorApi());
        $this->assertInstanceOf('LoLApi\Api\MasteryApi', $apiClient->getMasteriesApi());
        $this->assertInstanceOf('LoLApi\Api\RuneApi', $apiClient->getRunesApi());
        $this->assertInstanceOf('LoLApi\Api\StaticDataApi', $apiClient->getStaticDataApi());
        $this->assertInstanceOf('LoLApi\Api\LeagueApi', $apiClient->getLeagueApi());
        $this->assertInstanceOf('LoLApi\Api\StatusApi', $apiClient->getStatusApi());
        $this->assertInstanceOf('LoLApi\Api\ChampionMasteryApi', $apiClient->getChampionMasteryApi());
    }

    /**
     * @covers LoLApi\ApiClient::getRegion
     * @covers LoLApi\ApiClient::getApiKey
     * @covers LoLApi\ApiClient::getHttpClient
     * @covers LoLApi\ApiClient::getGlobalUrl
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

        $apiClient->setCacheProvider(new NullAdapter());
        $this->assertInstanceOf(NullAdapter::class, $apiClient->getCacheProvider());

        $apiClient->setCacheProvider(new ArrayAdapter());
        $this->assertInstanceOf(ArrayAdapter::class, $apiClient->getCacheProvider());
    }

    /**
     * @covers LoLApi\ApiClient::cacheApiResult
     */
    public function testCacheApiResult()
    {
        $apiResult  = new ApiResult();
        $arrayCache = new ArrayAdapter();

        $client = new ApiClient(ApiClient::REGION_EUW, 'test', $arrayCache);

        $client->cacheApiResult($apiResult);
    }

    /**
     * @covers LoLApi\ApiClient::getBaseUrlWithPlatformId
     */
    public function testGetBaseUrlWithPlatformId()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test', null, null);
        $class     = new \ReflectionClass('LoLApi\ApiClient');
        $method    = $class->getMethod('getBaseUrl');
        $method->setAccessible(true);

        $this->assertEquals('https://euw1.api.riotgames.com', $method->invoke($apiClient, true));
    }

    /**
     * @covers LoLApi\ApiClient::__construct
     *
     * @expectedException \LoLApi\Exception\InvalidRegionException
     */
    public function testInvalidRegion()
    {
        new ApiClient('test', 'test');
    }

    /**
     * @covers LoLApi\ApiClient::__construct
     */
    public function testConstructWithClient()
    {
        $httpClient = new Client();
        $apiClient  = new ApiClient(ApiClient::REGION_EUW, 'test', new NullAdapter(), $httpClient);

        $this->assertSame($httpClient, $apiClient->getHttpClient());
    }

    /**
     * @covers LoLApi\ApiClient::__construct
     */
    public function testConstruct()
    {
        $apiClient = new ApiClient(ApiClient::REGION_EUW, 'test', new NullAdapter());

        $this->assertInstanceOf('GuzzleHttp\Client', $apiClient->getHttpClient());
    }
}
