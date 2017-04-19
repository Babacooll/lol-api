<?php

namespace LoLApi;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use LoLApi\Api\ChampionApi;
use LoLApi\Api\ChampionMasteryApi;
use LoLApi\Api\CurrentGameApi;
use LoLApi\Api\FeaturedGamesApi;
use LoLApi\Api\GameApi;
use LoLApi\Api\LeagueApi;
use LoLApi\Api\MasteryApi;
use LoLApi\Api\MatchApi;
use LoLApi\Api\MatchListApi;
use LoLApi\Api\RuneApi;
use LoLApi\Api\StaticDataApi;
use LoLApi\Api\StatsApi;
use LoLApi\Api\StatusApi;
use LoLApi\Api\SummonerApi;
use LoLApi\Api\TeamApi;
use LoLApi\Exception\InvalidRegionException;
use LoLApi\Result\ApiResult;

/**
 * Class ApiClient
 *
 * @package LoLApi
 */
class ApiClient
{
    const REGION_BR   = 'br';
    const REGION_EUNE = 'eune';
    const REGION_EUW  = 'euw';
    const REGION_JP   = 'jp';
    const REGION_KR   = 'kr';
    const REGION_LAN  = 'lan';
    const REGION_LAS  = 'las';
    const REGION_NA   = 'na';
    const REGION_OCE  = 'oce';
    const REGION_TR   = 'tr';
    const REGION_RU   = 'ru';

    const REGION_BR_ID   = 'br1';
    const REGION_EUNE_ID = 'eun1';
    const REGION_EUW_ID  = 'euw1';
    const REGION_JP_ID   = 'jp1';
    const REGION_KR_ID   = 'kr';
    const REGION_LAN_ID  = 'la1';
    const REGION_LAS_ID  = 'la2';
    const REGION_NA_ID   = 'na1';
    const REGION_OCE_ID  = 'oc1';
    const REGION_TR_ID   = 'tr1';
    const REGION_RU_ID   = 'ru';

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
        self::REGION_TR,
    ];

    public static $regionsWithIds = [
        self::REGION_BR   => self::REGION_BR_ID,
        self::REGION_EUNE => self::REGION_EUNE_ID,
        self::REGION_EUW  => self::REGION_EUW_ID,
        self::REGION_KR   => self::REGION_KR_ID,
        self::REGION_LAN  => self::REGION_LAN_ID,
        self::REGION_LAS  => self::REGION_LAS_ID,
        self::REGION_NA   => self::REGION_NA_ID,
        self::REGION_OCE  => self::REGION_OCE_ID,
        self::REGION_RU   => self::REGION_RU_ID,
        self::REGION_TR   => self::REGION_TR_ID,
    ];

    /**
     * @var string
     */
    protected $region;

    /**
     * @var bool
     */
    protected $endpointStandardization;

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
     * @param bool          $endpointStandardization
     *
     * @throws InvalidRegionException
     */
    public function __construct($region, $apiKey, CacheProvider $cacheProvider = null, Client $client = null, $endpointStandardization = false)
    {
        if (!in_array($region, self::$availableRegions)) {
            throw new InvalidRegionException(sprintf('Invalid region %s', $region));
        }

        $this->endpointStandardization = $endpointStandardization;
        $this->region                  = $region;
        $this->httpClient              = $client ? $client : new Client();
        $this->apiKey                  = $apiKey;
        $this->cacheProvider           = $cacheProvider ? $cacheProvider : new VoidCache();
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
     * @return MasteryApi
     */
    public function getMasteriesApi()
    {
        return new MasteryApi($this);
    }

    /**
     * @return RuneApi
     */
    public function getRunesApi()
    {
        return new RuneApi($this);
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
     * @return LeagueApi
     */
    public function getLeagueApi()
    {
        return new LeagueApi($this);
    }

    /**
     * @return StaticDataApi
     */
    public function getStaticDataApi()
    {
        return new StaticDataApi($this);
    }

    /**
     * @return StatusApi
     */
    public function getStatusApi()
    {
        return new StatusApi($this);
    }

    /**
     * @return ChampionMasteryApi
     */
    public function getChampionMasteryApi()
    {
        return new ChampionMasteryApi($this);
    }

    /**
     * @param bool $endpointStandardization
     *
     * @return string
     */
    public function getBaseUrl($endpointStandardization = false)
    {
        if ($endpointStandardization === true) {
            return 'https://' . self::$regionsWithIds[$this->region] . '.api.riotgames.com';
        }

        return 'https://' . $this->region . '.api.pvp.net';
    }

    /**
     * @return string
     */
    public function getGlobalUrl()
    {
        return 'https://global.api.riotgames.com';
    }

    /**
     * @return string
     */
    public function getStatusUrl()
    {
        return 'http://status.leagueoflegends.com';
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
