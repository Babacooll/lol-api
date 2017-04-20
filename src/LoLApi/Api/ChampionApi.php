<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class ChampionApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class ChampionApi extends BaseApi
{
    const API_URL_CHAMPIONS_ALL = '/lol/platform/v3/champions';
    const API_URL_CHAMPION_BY_ID = '/lol/platform/v3/champions/{id}';

    /**
     * @param bool $onlyFreeToPlay
     *
     * @return ApiResult
     */
    public function getAllChampions($onlyFreeToPlay = false)
    {
        // The json_encode trick is here to change the boolean to a string representation of the boolean
        return $this->callApiUrl(self::API_URL_CHAMPIONS_ALL, ['freeToPlay' => json_encode($onlyFreeToPlay)], true);
    }

    /**
     * @param int $championId
     *
     * @return ApiResult
     */
    public function getChampionById($championId)
    {
        $url = str_replace('{id}', $championId, self::API_URL_CHAMPION_BY_ID);

        return $this->callApiUrl($url, [], true);
    }
}
