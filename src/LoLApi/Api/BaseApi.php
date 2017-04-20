<?php

namespace LoLApi\Api;

use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use LoLApi\ApiClient;
use LoLApi\Handler\ClientExceptionHandler;
use LoLApi\Result\ApiResult;

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
     * @param bool   $endpointStandardization (https://discussion.developer.riotgames.com/articles/652/riot-games-api-v3.html)
     * @param bool   $global
     * @param bool   $status
     *
     * @return ApiResult
     * @throws \LoLApi\Exception\AbstractRateLimitException
     */
    protected function callApiUrl($url, array $queryParameters = [], $endpointStandardization = false, $global = false, $status = false)
    {
        $queryParameters = array_merge(['api_key' => $this->apiClient->getApiKey()], $queryParameters);
        $fullUrl         = $this->buildUri($url, $queryParameters, $global, $endpointStandardization);

        if ($this->apiClient->getCacheProvider()->contains($fullUrl)) {
            return $this->buildApiResult($fullUrl, json_decode($this->apiClient->getCacheProvider()->fetch($fullUrl), true), true);
        }

        try {
            $response = $this->apiClient->getHttpClient()->get($fullUrl);

            return $this->buildApiResult($fullUrl, json_decode((string) $response->getBody(), true), false, $response);
        } catch (ClientException $e) {
            throw (new ClientExceptionHandler())->handleClientException($e);
        }
    }

    /**
     * @param string $url
     * @param array  $queryParameters
     * @param bool   $global
     * @param bool   $endpointStandardization
     *
     * @return string
     */
    protected function buildUri($url, array $queryParameters, $global = false, $endpointStandardization = false)
    {
        $baseUrl = $global ? $this->apiClient->getGlobalUrl() : $this->apiClient->getBaseUrl($endpointStandardization);

        if ($endpointStandardization === false) {
            $url = str_replace('{region}', $this->apiClient->getRegion(), $url);
        }

        return $baseUrl . $url . '?' . http_build_query($queryParameters);
    }

    /**
     * @param string                 $fullUrl
     * @param mixed                  $result
     * @param bool                   $fetchedFromCache
     * @param ResponseInterface|null $response
     *
     * @return ApiResult
     */
    protected function buildApiResult($fullUrl, $result, $fetchedFromCache, ResponseInterface $response = null)
    {
        return (new ApiResult())
            ->setResult($result)
            ->setUrl($fullUrl)
            ->setHttpResponse($response)
            ->setFetchedFromCache($fetchedFromCache)
        ;
    }
}
