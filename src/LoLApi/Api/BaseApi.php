<?php

namespace LoLApi\Api;

use GuzzleHttp\Exception\ClientException;
use LoLApi\ApiClient;
use LoLApi\Handler\ClientExceptionHandler;
use GuzzleHttp\Psr7;
use LoLApi\Result\ApiResult;
use Psr\Http\Message\ResponseInterface;

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
     * @return ApiResult|null
     */
    protected function callApiUrl($url, array $queryParameters = [])
    {
        $url             = str_replace('{region}', $this->apiClient->getRegion(), $url);
        $queryParameters = array_merge(['api_key' => $this->apiClient->getApiKey()], $queryParameters);
        $fullUrl         = $this->buildUri($url, $queryParameters);

        if ($this->apiClient->getCacheProvider()->contains($fullUrl)) {
            return $this->buildApiResult($fullUrl, json_decode($this->apiClient->getCacheProvider()->fetch($fullUrl), true), true);
        }

        try {
            $response = $this->apiClient->getHttpClient()->get($url, ['query' => $queryParameters]);

            return $this->buildApiResult($fullUrl, json_decode((string) $response->getBody(), true), false, $response);
        } catch (ClientException $e) {
            (new ClientExceptionHandler())->handleClientException($e);
        }

        return null;
    }

    /**
     * @param string $url
     * @param array  $queryParameters
     *
     * @return string
     */
    protected function buildUri($url, array $queryParameters)
    {
        return $this->apiClient->getBaseUrlWithRegion() . $url . '?' . http_build_query($queryParameters);
    }

    /**
     * @param string                 $fullUrl
     * @param array                  $result
     * @param bool                   $fetchedFromCache
     * @param ResponseInterface|null $response
     *
     * @return $this
     */
    protected function buildApiResult($fullUrl, array $result, $fetchedFromCache, ResponseInterface $response = null)
    {
        return (new ApiResult())
            ->setResult($result)
            ->setUrl($fullUrl)
            ->setHttpResponse($response)
            ->setFetchedFromCache($fetchedFromCache);
    }
}
