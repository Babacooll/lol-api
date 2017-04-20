<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class SummonerApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class SummonerApi extends BaseApi
{
    const API_URL_SUMMONER_BY_NAME = '/lol/summoner/v3/summoners/by-name/{summonerName}';
    const API_URL_SUMMONER_BY_ID = '/lol/summoner/v3/summoners/{summonerId}';
    const API_URL_SUMMONER_BY_ACCOUNT_ID = '/lol/summoner/v3/summoners/by-account/{accountId}';

    /**
     * @param string $summonerName
     *
     * @return ApiResult
     */
    public function getSummonerBySummonerName($summonerName)
    {
        $url = str_replace('{summonerName}', $summonerName, self::API_URL_SUMMONER_BY_NAME);

        return $this->callApiUrl($url, [], true);
    }

    /**
     * @param string $summonerId
     *
     * @return ApiResult
     */
    public function getSummonerBySummonerId($summonerId)
    {
        $url = str_replace('{summonerId}', $summonerId, self::API_URL_SUMMONER_BY_ID);

        return $this->callApiUrl($url, [], true);
    }

    /**
     * @param string $accountId
     *
     * @return ApiResult
     */
    public function getSummonerByAccountId($accountId)
    {
        $url = str_replace('{accountId}', $accountId, self::API_URL_SUMMONER_BY_ACCOUNT_ID);

        return $this->callApiUrl($url, [], true);
    }
}
