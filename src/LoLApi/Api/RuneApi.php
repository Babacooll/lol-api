<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class RuneApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class RuneApi extends BaseApi
{
    const API_URL_RUNES_BY_SUMMONER_ID = '/lol/platform/v3/runes/by-summoner/{summonerId}';

    /**
     * @param string $summonerId
     *
     * @return ApiResult
     */
    public function getRunesBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_RUNES_BY_SUMMONER_ID);

        return $this->callApiUrl($url, [], true);
    }
}
