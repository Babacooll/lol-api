<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class ChampionMasteryApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class ChampionMasteryApi extends BaseApi
{
    const API_URL_CHAMPION_MASTERY_BY_ID = '/championmastery/location/{platformId}/player/{playerId}/champion/{championId}';
    const API_URL_CHAMPION_MASTERY_ALL = '/championmastery/location/{platformId}/player/{playerId}/champions';
    const API_URL_CHAMPION_MASTERY_SCORE = '/championmastery/location/{platformId}/player/{playerId}/score';
    const API_URL_CHAMPION_MASTERY_TOP = '/championmastery/location/{platformId}/player/{playerId}/topchampions';

    /**
     * @param int $platformId
     * @param int $championId
     * @param int $playerId
     *
     * @return ApiResult
     */
    public function getChampionMastery($platformId, $championId, $playerId)
    {
        $url = str_replace('{championId}', $championId, self::API_URL_CHAMPION_MASTERY_BY_ID);
        $url = str_replace('{playerId}', $playerId, $url);
        $url = str_replace('{platformId}', $platformId, $url);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int $platformId
     * @param int $playerId
     *
     * @return ApiResult
     */
    public function getChampionsMasteries($platformId, $playerId)
    {
        $url = str_replace('{playerId}', $playerId, self::API_URL_CHAMPION_MASTERY_ALL);
        $url = str_replace('{platformId}', $platformId, $url);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int $platformId
     * @param int $playerId
     *
     * @return ApiResult
     */
    public function getChampionsMasteriesScore($platformId, $playerId)
    {
        $url = str_replace('{playerId}', $playerId, self::API_URL_CHAMPION_MASTERY_SCORE);
        $url = str_replace('{platformId}', $platformId, $url);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int $platformId
     * @param int $playerId
     * @param int $limit
     *
     * @return ApiResult
     */
    public function getTopChampionsMasteries($platformId, $playerId, $limit = 3)
    {
        $url = str_replace('{playerId}', $playerId, self::API_URL_CHAMPION_MASTERY_TOP);
        $url = str_replace('{platformId}', $platformId, $url);

        $queryParameters = [];

        $queryParameters['count'] = (int) $limit;

        return $this->callApiUrl($url, array_filter($queryParameters));
    }
}
