<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class TeamApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api/methods
 */
class TeamApi extends BaseApi
{
    const API_URL_TEAM_BY_SUMMONERS_IDS = '/api/lol/{region}/v2.4/team/by-summoner/{summonerIds}';
    const API_URL_TEAM_BY_TEAMS_IDS = '/api/lol/{region}/v2.4/team/{teamIds}';

    /**
     * @param array $summonerIds
     *
     * @return ApiResult
     */
    public function getTeamsBySummonersIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_TEAM_BY_SUMMONERS_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $teamsIds
     *
     * @return ApiResult
     */
    public function getTeamsByTeamsIds(array $teamsIds = [])
    {
        $url = str_replace('{teamIds}', implode(',', $teamsIds), self::API_URL_TEAM_BY_TEAMS_IDS);

        return $this->callApiUrl($url, []);
    }
}
