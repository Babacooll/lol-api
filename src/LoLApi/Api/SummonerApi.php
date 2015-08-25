<?php

namespace LoLApi\Api;

/**
 * Class SummonerApi
 *
 * @package LoLApi\Api
 */
class SummonerApi extends BaseApi
{
    const API_URL_SUMMONERS_BY_NAMES = '/api/lol/{region}/v1.4/summoner/by-name/{summonerNames}';
    const API_URL_SUMMONERS_BY_IDS = '/api/lol/{region}/v1.4/summoner/{summonerIds}';
    const API_URL_SUMMONERS_MASTERIES_BY_IDS = '/api/lol/{region}/v1.4/summoner/{summonerIds}/masteries';
    const API_URL_SUMMONERS_NAMES_BY_IDS = '/api/lol/{region}/v1.4/summoner/{summonerIds}/name';
    const API_URL_SUMMONERS_RUNES_BY_IDS = '/api/lol/{region}/v1.4/summoner/{summonerIds}/runes';

    /**
     * @param array $summonerNames
     *
     * @return array
     */
    public function getSummonersBySummonerNames(array $summonerNames = [])
    {
        $url = str_replace('{summonerNames}', implode(',', $summonerNames), self::API_URL_SUMMONERS_BY_NAMES);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $summonerIds
     *
     * @return array
     */
    public function getSummonersBySummonerIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_SUMMONERS_BY_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $summonerIds
     *
     * @return array
     */
    public function getSummonersMasteriesBySummonerIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_SUMMONERS_MASTERIES_BY_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $summonerIds
     *
     * @return array
     */
    public function getSummonersNamesBySummonerIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_SUMMONERS_NAMES_BY_IDS);

        return $this->callApiUrl($url, []);
    }

    /**
     * @param array $summonerIds
     *
     * @return array
     */
    public function getSummonersRunesBySummonerIds(array $summonerIds = [])
    {
        $url = str_replace('{summonerIds}', implode(',', $summonerIds), self::API_URL_SUMMONERS_RUNES_BY_IDS);

        return $this->callApiUrl($url, []);
    }
}
