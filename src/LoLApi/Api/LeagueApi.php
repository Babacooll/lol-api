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
    const API_URL_LEAGUE_BY_SUMMONER_ID = '/lol/league/v3/leagues/by-summoner/{summonerId}';
    const API_URL_LEAGUE_POSITION_BY_SUMMONER_ID = '/lol/league/v3/positions/by-summoner/{summonerId}';
    const API_URL_LEAGUE_CHALLENGER = '/lol/league/v3/challengerleagues/by-queue/{queue}';
    const API_URL_LEAGUE_MASTER = '/lol/league/v3/masterleagues/by-queue/{queue}';

    /**
     * @param int $summonerId
     *
     * @return ApiResult
     */
    public function getLeagueBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_LEAGUE_BY_SUMMONER_ID);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int $summonerId
     *
     * @return ApiResult
     */
    public function getLeaguePositionsBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_LEAGUE_POSITION_BY_SUMMONER_ID);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5)
     *
     * @return ApiResult
     */
    public function getChallengerLeagues($gameQueueType)
    {
        $url = str_replace('{queue}', $gameQueueType, self::API_URL_LEAGUE_CHALLENGER);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5)
     *
     * @return ApiResult
     */
    public function getMasterLeagues($gameQueueType)
    {
        $url = str_replace('{queue}', $gameQueueType, self::API_URL_LEAGUE_MASTER);

        return $this->callApiUrl($url, []);
    }
}
