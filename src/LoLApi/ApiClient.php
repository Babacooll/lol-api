<?php

namespace LoLApi;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use LoLApi\Api\ChampionApi;
use LoLApi\Api\CurrentGameApi;
use LoLApi\Api\FeaturedGamesApi;
use LoLApi\Api\GameApi;
use LoLApi\Api\MatchApi;
use LoLApi\Api\MatchListApi;
use LoLApi\Api\StatsApi;
use LoLApi\Api\SummonerApi;
use LoLApi\Api\TeamApi;
use LoLApi\Result\ApiResult;

/**
 * Class ApiClient
 *
 * @package LoLApi
 */
class ApiClient
{
    const REGION_BR = 'br';
    const REGION_EUNE = 'eune';
    const REGION_EUW = 'euw';
    const REGION_KR = 'kr';
    const REGION_LAN = 'lan';
    const REGION_LAS = 'las';
    const REGION_NA = 'na';
    const REGION_OCE = 'oce';
    const REGION_RU = 'ru';
    const REGION_TR = 'tr';

    /**
     * @var array
     */
    public static $availableRegions = [
        self::REGION_BR,
        self::REGION_EUNE,
        self::REGION_EUW,
        self::REGION_KR,
        self::REGION_LAN,
        self::REGION_LAS,
        self::REGION_NA,
        self::REGION_OCE,
        self::REGION_RU,
        self::REGION_TR
    ];

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var CacheProvider
     */
    protected $cacheProvider;

    /**
     * @param string        $region
     * @param string        $apiKey
     * @param CacheProvider $cacheProvider
     * @param Client        $client
     *
     * @throws \Exception
     */
    public function __construct($region, $apiKey, CacheProvider $cacheProvider = null, Client $client = null)
    {
        if (!in_array($region, self::$availableRegions)) {
            throw new \Exception(sprintf('Invalid region %s', $region));
        }

        $this->region        = $region;
        $this->httpClient    = $client ? $client : new Client(['base_uri' => $this->getBaseUrlWithRegion()]);
        $this->apiKey        = $apiKey;
        $this->cacheProvider = $cacheProvider ? $cacheProvider : new VoidCache();
    }

    /**
     * @param CacheProvider $cacheProvider
     */
    public function setCacheProvider(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
    }

    /**
     * @return CacheProvider
     */
    public function getCacheProvider()
    {
        return $this->cacheProvider;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return MatchListApi
     */
    public function getMatchListApi()
    {
        return new MatchListApi($this);
    }

    /**
     * @return MatchApi
     */
    public function getMatchApi()
    {
        return new MatchApi($this);
    }

    /**
     * @return SummonerApi
     */
    public function getSummonerApi()
    {
        return new SummonerApi($this);
    }

    /**
     * @return ChampionApi
     */
    public function getChampionApi()
    {
        return new ChampionApi($this);
    }

    /**
     * @return FeaturedGamesApi
     */
    public function getFeaturedGamesApi()
    {
        return new FeaturedGamesApi($this);
    }

    /**
     * @return StatsApi
     */
    public function getStatsApi()
    {
        return new StatsApi($this);
    }

    /**
     * @return TeamApi
     */
    public function getTeamApi()
    {
        return new TeamApi($this);
    }

    /**
     * @return GameApi
     */
    public function getGameApi()
    {
        return new GameApi($this);
    }

    /**
     * @return CurrentGameApi
     */
    public function getCurrentGameApi()
    {
        return new CurrentGameApi($this);
    }

    /**
     * @return string
     */
    public function getBaseUrlWithRegion()
    {
        return 'https://' . $this->region . '.api.pvp.net';
    }

    /**
     * @param ApiResult $apiResult
     * @param int       $ttl
     */
    public function cacheApiResult(ApiResult $apiResult, $ttl = 60)
    {
        $this->cacheProvider->save($apiResult->getUrl(), json_encode($apiResult->getResult()), $ttl);
    }
}
