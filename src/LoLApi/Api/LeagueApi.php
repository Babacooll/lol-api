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
    const API_URL_LEAGUE_BY_SUMMONERS_IDS = '/api/lol/{region}/v2.5/league/by-summoner/{summonerIds}';
    const API_URL_LEAGUE_ENTRIES_BY_SUMMONERS_IDS = '/api/lol/{region}/v2.5/league/by-summoner/{summonerIds}/entry';
    const API_URL_LEAGUE_CHALLENGER = '/api/lol/{region}/v2.5/league/challenger';
    const API_URL_LEAGUE_MASTER = '/api/lol/{region}/v2.5/league/master';

    /**
     * @param array $summonerIds
     *
     * @return ApiResult
     */
    public function getLeagueBySummonersIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_LEAGUE_BY_SUMMONERS_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $summonerIds
     *
     * @return ApiResult
     */
    public function getLeagueEntriesBySummonersIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_LEAGUE_ENTRIES_BY_SUMMONERS_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5)
     *
     * @return ApiResult
     */
    public function getChallengerLeagues($gameQueueType)
    {
        return $this->callApiUrl(self::API_URL_LEAGUE_CHALLENGER, ['type' => $gameQueueType]);
    }

    /**
     * @param string $gameQueueType (Can be RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5)
     *
     * @return ApiResult
     */
    public function getMasterLeagues($gameQueueType)
    {
        return $this->callApiUrl(self::API_URL_LEAGUE_MASTER, ['type' => $gameQueueType]);
    }
}
