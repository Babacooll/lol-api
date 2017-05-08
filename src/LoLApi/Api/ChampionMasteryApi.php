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
    const API_URL_CHAMPION_MASTERY_BY_ID = '/lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}';
    const API_URL_CHAMPION_MASTERY_BY_CHAMPION_ID = '/lol/champion-mastery/v3/champion-masteries/by-summoner/{summonerId}/by-champion/{championId}';
    const API_URL_CHAMPION_MASTERY_SCORE = '/lol/champion-mastery/v3/scores/by-summoner/{summonerId}';

    /**
     * Get all champion mastery entries sorted by number of champion points descending,
     *
     * @param int $summonerId
     *
     * @return ApiResult
     */
    public function getChampionsMasteries($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_CHAMPION_MASTERY_BY_ID);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int $summonerId
     * @param int $championId
     *
     * @return ApiResult
     */
    public function getChampionMastery($summonerId, $championId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_CHAMPION_MASTERY_BY_CHAMPION_ID);
        $url = str_replace('{championId}', $championId, $url);

        return $this->callApiUrl($url, []);
    }

    /**
     * Get a player's total champion mastery score, which is the sum of individual champion mastery levels
     *
     * @param int $summonerId
     *
     * @return ApiResult
     */
    public function getChampionsMasteriesScore($summonerId)
    {
        $url = str_replace('{playerId}', $summonerId, self::API_URL_CHAMPION_MASTERY_SCORE);

        return $this->callApiUrl($url, []);
    }
}
