<?php

namespace LoLApi\Result;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiResult
 *
 * @package LoLApi\Result
 */
class ApiResult
{
    /** @var ResponseInterface */
    protected $httpResponse;

    /** @var mixed */
    protected $result;

    /** @var string */
    protected $url;

    /** @var bool */
    protected $fetchedFromCache = false;

    /**
     * @return ResponseInterface
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * @param ResponseInterface $httpResponse
     *
     * @return $this
     */
    public function setHttpResponse($httpResponse = null)
    {
        $this->httpResponse = $httpResponse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     *
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isFetchedFromCache()
    {
        return $this->fetchedFromCache;
    }

    /**
     * @param boolean $fetchedFromCache
     *
     * @return $this
     */
    public function setFetchedFromCache($fetchedFromCache)
    {
        $this->fetchedFromCache = $fetchedFromCache;

        return $this;
    }
}
