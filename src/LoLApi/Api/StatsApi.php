<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class StatsApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class StatsApi extends BaseApi
{
    const API_URL_STATS_RANKED_BY_SUMMONER_ID = '/api/lol/{region}/v1.3/stats/by-summoner/{summonerId}/ranked';
    const API_URL_STATS_SUMMARY_BY_SUMMONER_ID = '/api/lol/{region}/v1.3/stats/by-summoner/{summonerId}/summary';

    /**
     * @param string $summonerId
     * @param string $season
     * @param string $season
     *
     * @return ApiResult
     */
    public function getRankedStatsBySummonerId($summonerId, $season = null)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_STATS_RANKED_BY_SUMMONER_ID);

        return $this->callApiUrl($url, $this->handleQueryParametersForSeason($season));
    }

    /**
     * @param string $summonerId
     * @param string $season
     * @param string $season
     *
     * @return ApiResult
     */
    public function getRankedSummaryBySummonerId($summonerId, $season = null)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_STATS_SUMMARY_BY_SUMMONER_ID);

        return $this->callApiUrl($url, $this->handleQueryParametersForSeason($season));
    }

    /**
     * @param string $season
     *
     * @return array
     */
    protected function handleQueryParametersForSeason($season = null)
    {
        $queryParameters = [];

        if ($season !== null) {
            $queryParameters['season'] = (string) $season;
        }

        return $queryParameters;
    }
}
