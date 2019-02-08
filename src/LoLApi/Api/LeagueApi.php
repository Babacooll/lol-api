<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class LeagueApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class LeagueApi extends BaseApi
{
    const API_URL_LEAGUE_POSITION_BY_SUMMONER_ID = '/lol/league/v4/positions/by-summoner/{encryptedSummonerId}';
    const API_URL_LEAGUE_CHALLENGER = '/lol/league/v4/challengerleagues/by-queue/{queue}';
    const API_URL_LEAGUE_MASTER = '/lol/league/v4/masterleagues/by-queue/{queue}';
    const API_URL_LEAGUE_GRAND_MASTER = '/lol/league/v4/grandmasterleagues/by-queue/{queue}';

    /**
     * @param int $summonerId
     *
     * @return ApiResult
     */
    public function getLeaguePositionsBySummonerId($summonerId)
    {
        $url = str_replace('{encryptedSummonerId}', $summonerId, self::API_URL_LEAGUE_POSITION_BY_SUMMONER_ID);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_FLEX_SR, RANKED_FLEX_TT)
     *
     * @return ApiResult
     */
    public function getChallengerLeagues($gameQueueType)
    {
        $url = str_replace('{queue}', $gameQueueType, self::API_URL_LEAGUE_CHALLENGER);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_FLEX_SR, RANKED_FLEX_TT)
     *
     * @return ApiResult
     */
    public function getMasterLeagues($gameQueueType)
    {
        $url = str_replace('{queue}', $gameQueueType, self::API_URL_LEAGUE_MASTER);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_FLEX_SR, RANKED_FLEX_TT)
     *
     * @return ApiResult
     */
    public function getGrandMasterLeagues($gameQueueType)
    {
        $url = str_replace('{queue}', $gameQueueType, self::API_URL_LEAGUE_MASTER);

        return $this->callApiUrl($url, []);
    }
}
