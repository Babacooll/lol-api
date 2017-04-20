<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class MasteryApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class MasteryApi extends BaseApi
{
    const API_URL_MASTERIES_BY_SUMMONER_ID = '/lol/platform/v3/masteries/by-summoner/{summonerId}';

    /**
     * @param string $summonerId
     *
     * @return ApiResult
     */
    public function getMasteriesBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_MASTERIES_BY_SUMMONER_ID);

        return $this->callApiUrl($url, [], true);
    }
}
