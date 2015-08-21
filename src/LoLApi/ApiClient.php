<?php

namespace LoLApi;

use GuzzleHttp\Client;
use LoLApi\Api\ChampionApi;
use LoLApi\Api\FeaturedGamesApi;
use LoLApi\Api\MatchApi;
use LoLApi\Api\MatchListApi;
use LoLApi\Api\SummonerApi;

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
     * @param string $region
     * @param string $apiKey
     *
     * @throws \Exception
     */
    public function __construct($region, $apiKey)
    {
        if (!in_array($region, self::$availableRegions)) {
            throw new \Exception(sprintf('Invalid region %s', $region));
        }

        $this->region     = $region;
        $this->httpClient = new Client(['base_uri' => $this->getBaseUrWithRegion()]);
        $this->apiKey     = $apiKey;
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
     * @return string
     */
    protected function getBaseUrWithRegion()
    {
        return 'https://' . $this->region . '.api.pvp.net';
    }
}
