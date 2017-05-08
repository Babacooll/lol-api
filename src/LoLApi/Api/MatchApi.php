<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class MatchApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class MatchApi extends BaseApi
{
    const API_URL_MATCH_BY_ID = '/lol/match/v3/matches/{matchId}';
    const API_URL_MATCH_LIST_BY_ACCOUNT = '/lol/match/v3/matchlists/by-account/{accountId}';
    const API_URL_RECENT_MATCH_LIST_BY_ACCOUNT = '/lol/match/v3/matchlists/by-account/{accountId}/recent';
    const API_URL_TIMELINES_BY_MATCH_ID = '/lol/match/v3/timelines/by-match/{matchId}';
    const API_URL_MATCH_ID_BY_TOURNAMENT_CODE = '/lol/match/v3/matches/by-tournament-code/{tournamentCode}/ids';
    const API_URL_MATCH_BY_MATCH_ID_AND_TOURNAMENT_CODE = '/lol/match/v3/matches/{matchId}/by-tournament-code/{tournamentCode}';

    /**
     * @param int $matchId
     *
     * @return ApiResult
     */
    public function getMatchByMatchId($matchId)
    {
        $url = str_replace('{matchId}', $matchId, self::API_URL_MATCH_BY_ID);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param int   $accountId
     * @param array $championIds
     * @param array $rankedQueues
     * @param array $seasons
     * @param int   $beginTime
     * @param int   $endTime
     * @param int   $beginIndex
     * @param int   $endIndex
     *
     * @return ApiResult
     */
    public function getMatchListByAccountId($accountId, array $championIds = [], array $rankedQueues = [], array $seasons = [], $beginTime = null, $endTime = null, $beginIndex = null, $endIndex = null)
    {
        $url             = str_replace('{accountId}', $accountId, self::API_URL_MATCH_LIST_BY_ACCOUNT);
        $queryParameters = [];

        $queryParameters['championIds']  = implode(',', $championIds);
        $queryParameters['rankedQueues'] = implode(',', $rankedQueues);
        $queryParameters['seasons']      = implode(',', $seasons);
        $queryParameters['beginTime']    = $beginTime;
        $queryParameters['endTime']      = $endTime;
        $queryParameters['beginIndex']   = $beginIndex;
        $queryParameters['endIndex']     = $endIndex;

        return $this->callApiUrl($url, array_filter($queryParameters));
    }


    /**
     * Get matchlist for last 20 matches played on given account ID and platform ID.
     *
     * @throws \Exception
     */
    public function getLastMatchlistByAccountId()
    {
        throw new \Exception("Method not implemented yet");
    }

    /**
     * Get match timeline by match ID.
     *
     * @throws \Exception
     */
    public function getTimelineByMatchId()
    {
        throw new \Exception("Method not implemented yet");
    }

    /**
     * Get match IDs by tournament code.
     *
     * @param string $tournamentCode
     *
     * @throws \Exception
     */
    public function getMatchIdByTournamentCode($tournamentCode)
    {
        throw new \Exception("Method not implemented yet");
    }

    /**
     * Get match by match ID and tournament code.
     *
     * @param int    $matchId
     * @param string $tournamentCode
     *
     * @throws \Exception
     */
    public function getMatchByMatchIdAndTournamentCode($matchId, $tournamentCode)
    {
        throw new \Exception("Method not implemented yet");
    }
}
