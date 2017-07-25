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
    const API_URL_SHARDS = '/lol/status/v3/shard-data';

    /**
     * Requests to this API are not counted against the application Rate Limits.
     *
     * @return ApiResult
     */
    public function getShards()
    {
        return $this->callApiUrl(self::API_URL_SHARDS, []);
    }
}
