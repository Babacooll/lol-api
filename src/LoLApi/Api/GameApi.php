<?php

namespace LoLApi\Api;

/**
 * Class GameApi
 *
 * @package LoLApi\Api
 */
class GameApi extends BaseApi
{
    const API_URL_RECENT_GAME_BY_SUMMONER_ID = '/api/lol/{region}/v1.3/game/by-summoner/{summonerId}/recent';

    /**
     * @param string $summonerId
     *
     * @return array
     */
    public function getRecentGamesBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_RECENT_GAME_BY_SUMMONER_ID);

        return $this->callApiUrl($url, []);
    }
}
