<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class FeaturedGamesApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class SpectatorApi extends BaseApi
{
    const API_URL_SPECTATOR_FEATURED = '/lol/spectator/v3/featured-games';
    const API_URL_CURRENT_GAME_BY_SUMMONER_ID = '/lol/spectator/v3/active-games/by-summoner/{summonerId}';

    /**
     * @return ApiResult
     */
    public function getFeaturedGames()
    {
        return $this->callApiUrl(self::API_URL_SPECTATOR_FEATURED, []);
    }

    /**
     * @param string $summonerId
     *
     * @return ApiResult
     */
    public function getCurrentGameByPlatformIdAndSummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_CURRENT_GAME_BY_SUMMONER_ID);

        return $this->callApiUrl($url, []);
    }
}
