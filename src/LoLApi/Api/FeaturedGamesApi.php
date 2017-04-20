<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class FeaturedGamesApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class FeaturedGamesApi extends BaseApi
{
    const API_URL_FEATURED = '/observer-mode/rest/featured';

    /**
     * @return ApiResult
     */
    public function getFeaturedGames()
    {
        return $this->callApiUrl(self::API_URL_FEATURED, []);
    }
}
