<?php

namespace LoLApi\Api;

use LoLApi\ApiClient;

/**
 * Class BaseApi
 *
 * @package LoLApi\Api
 */
abstract class BaseApi
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $url
     * @param array  $queryParameters
     *
     * @return array
     */
    protected function callApiUrl($url, array $queryParameters = [])
    {
        $url             = str_replace('{region}', $this->apiClient->getRegion(), $url);
        $queryParameters = array_merge(['api_key' => $this->apiClient->getApiKey()], $queryParameters);
        $response        = $this->apiClient->getHttpClient()->get($url, ['query' => $queryParameters]);

        return json_decode((string)$response->getBody(), true);
    }
}
