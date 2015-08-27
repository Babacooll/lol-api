<?php

namespace LoLApi\Tests\Result;

use GuzzleHttp\Psr7\Response;
use LoLApi\Result\ApiResult;

/**
 * Class ApiResult
 *
 * @package LoLApi\Tests\Result
 */
class ApiResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers LoLApi\Result\ApiResult::setHttpResponse
     * @covers LoLApi\Result\ApiResult::getHttpResponse
     */
    public function testHttpResponse()
    {
        $apiResult = new ApiResult();
        $response  = new Response();

        $this->assertSame($apiResult, $apiResult->setHttpResponse($response));
        $this->assertSame($response, $apiResult->getHttpResponse());
    }

    /**
     * @covers LoLApi\Result\ApiResult::getResult
     * @covers LoLApi\Result\ApiResult::setResult
     */
    public function testResult()
    {
        $apiResult = new ApiResult();
        $result    = ['test'];

        $this->assertSame($apiResult, $apiResult->setResult($result));
        $this->assertSame($result, $apiResult->getResult());
    }

    /**
     * @covers LoLApi\Result\ApiResult::getUrl
     * @covers LoLApi\Result\ApiResult::setUrl
     */
    public function testUrl()
    {
        $apiResult = new ApiResult();
        $url       = 'http://www.google.com';

        $this->assertSame($apiResult, $apiResult->setUrl($url));
        $this->assertSame($url, $apiResult->getUrl());
    }

    /**
     * @covers LoLApi\Result\ApiResult::isFetchedFromCache
     * @covers LoLApi\Result\ApiResult::setFetchedFromCache
     */
    public function testFetchedFromCache()
    {
        $apiResult = new ApiResult();

        $this->assertFalse($apiResult->isFetchedFromCache());
        $this->assertSame($apiResult, $apiResult->setFetchedFromCache(true));
        $this->assertTrue($apiResult->isFetchedFromCache());
    }
}
