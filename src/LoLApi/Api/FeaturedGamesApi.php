<?php

namespace LoLApi\Api;

/**
 * Class FeaturedGamesApi
 *
 * @package LoLApi\Api
 */
class FeaturedGamesApi extends BaseApi
{
    const API_URL_FEATURED = '/observer-mode/rest/featured';

    /**
     * @return array
     */
    public function getFeaturedGames()
    {
        return $this->callApiUrl(self::API_URL_FEATURED, []);
    }
}
