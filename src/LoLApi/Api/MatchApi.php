<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class MatchApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api/methods
 */
class MatchApi extends BaseApi
{
    const API_URL_MATCH_BY_ID = '/api/lol/{region}/v2.2/match/{matchId}';

    /**
     * @param int        $matchId
     * @param bool|false $includeTimeline
     *
     * @return ApiResult
     */
    public function getMatchByMatchId($matchId, $includeTimeline = false)
    {
        $url             = str_replace('{matchId}', $matchId, self::API_URL_MATCH_BY_ID);
        $queryParameters = [];

        $queryParameters['includeTimeline'] = (int) $includeTimeline;

        return $this->callApiUrl($url, array_filter($queryParameters));
    }
}
