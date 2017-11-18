<?php

namespace LoLApi;

use GuzzleHttp\Client;
use LoLApi\Api\ChampionApi;
use LoLApi\Api\ChampionMasteryApi;
use LoLApi\Api\SpectatorApi;
use LoLApi\Api\LeagueApi;
use LoLApi\Api\MasteryApi;
use LoLApi\Api\MatchApi;
use LoLApi\Api\RuneApi;
use LoLApi\Api\StaticDataApi;
use LoLApi\Api\StatusApi;
use LoLApi\Api\SummonerApi;
use LoLApi\Exception\InvalidRegionException;
use LoLApi\Result\ApiResult;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\NullAdapter;

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
        self::REGION_JP,
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
        self::REGION_JP   => self::REGION_JP_ID,
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
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var AdapterInterface
     */
    protected $cacheProvider;

    /**
     * @param string          $region
     * @param string          $apiKey
     * @param AdapterInterface $cache
     * @param Client          $client
     *
     * @throws InvalidRegionException
     */
    public function __construct($region, $apiKey, AdapterInterface $cache = null, Client $client = null)
    {
        if (!in_array($region, self::$availableRegions)) {
            throw new InvalidRegionException(sprintf('Invalid region %s', $region));
        }

        $this->region     = $region;
        $this->httpClient = $client ? $client : new Client();
        $this->apiKey     = $apiKey;
        $this->cache      = $cache ? $cache : new NullAdapter();
    }

    /**
     * @param AdapterInterface $cache
     */
    public function setCacheProvider(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return AdapterInterface
     */
    public function getCacheProvider()
    {
        return $this->cache;
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
     * @return SpectatorApi
     */
    public function getFeaturedGamesApi()
    {
        return new SpectatorApi($this);
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
     * @return SpectatorApi
     */
    public function getSpectatorApi()
    {
        return new SpectatorApi($this);
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
     * @return string
     */
    public function getBaseUrl()
    {
        return 'https://'.self::$regionsWithIds[$this->region].'.api.riotgames.com';
    }

    /**
     * @param ApiResult $apiResult
     * @param int       $ttl
     */
    public function cacheApiResult(ApiResult $apiResult, $ttl = 60)
    {
        $cacheKey = md5($apiResult->getUrl());

        $item = $this->cache->getItem($cacheKey);

        if (!$item->isHit()) {
           $item->set(json_encode($apiResult->getResult()));
           $item->expiresAfter($ttl);
           $this->cache->save($item);
        }
    }
}
