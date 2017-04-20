<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class CurrentGameApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class CurrentGameApi extends BaseApi
{
    const API_URL_CURRENT_GAME_BY_SUMMONER_ID = '/observer-mode/rest/consumer/getSpectatorGameInfo/{platformId}/{summonerId}';

    /**
     * @param string $platformId
     * @param string $summonerId
     *
     * @return ApiResult
     */
    public function getCurrentGameByPlatformIdAndSummonerId($platformId, $summonerId)
    {
        $url = str_replace('{platformId}', $platformId, self::API_URL_CURRENT_GAME_BY_SUMMONER_ID);
        $url = str_replace('{summonerId}', $summonerId, $url);

        return $this->callApiUrl($url, []);
    }
}
