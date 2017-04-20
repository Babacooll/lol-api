<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class StatusApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class StatusApi extends BaseApi
{
    const API_URL_SHARDS = '/shards';
    const API_URL_SHARDS_REGION = '/shards/{region}';

    /**
     * @return ApiResult
     */
    public function getShards()
    {
        return $this->callApiUrl(self::API_URL_SHARDS, [], false, true);
    }

    /**
     * @param string $region
     *
     * @return ApiResult
     */
    public function getShardsByRegion($region)
    {
        $url = str_replace('{region}', $region, self::API_URL_SHARDS_REGION);

        return $this->callApiUrl($url, [], false, true);
    }
}
