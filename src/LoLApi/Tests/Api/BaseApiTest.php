<?php

namespace LoLApi\Tests\Api;

use LoLApi\Tests\AbstractApiTest;

/**
 * Class BaseApiTest
 *
 * @package LoLApi\Tests\Api
 */
class BaseApiTest extends AbstractApiTest
{
    /**
     * @param string $api
     * @param string $method
     * @param array  $options
     *
     * @dataProvider dataProvider
     *
     * @covers LoLApi\Api\BaseApi
     * @covers LoLApi\Api\ChampionApi
     * @covers LoLApi\Api\FeaturedGamesApi
     * @covers LoLApi\Api\MatchApi
     * @covers LoLApi\Api\MatchListApi
     * @covers LoLApi\Api\SummonerApi
     */
    public function testAll($api, $method, array $options = [])
    {
        $api = $this->apiClient->{$api}();

        $this->assertSame(['success'], call_user_func_array([$api, $method], $options));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                'getMatchListApi',
                'getMatchListBySummonerId',
                [
                    5
                ]
            ],
            [
                'getChampionApi',
                'getAllChampions',
            ],
            [
                'getChampionApi',
                'getChampionById',
                [
                    5
                ]
            ],
            [
                'getFeaturedGamesApi',
                'getFeaturedGames'
            ],
            [
                'getMatchApi',
                'getMatchByMatchId',
                [
                    5
                ]
            ],
            [
                'getSummonerApi',
                'getSummonersBySummonerNames',
                [
                    ['test']
                ]
            ],
            [
                'getSummonerApi',
                'getSummonersBySummonerIds',
                [
                    [5]
                ]
            ],
            [
                'getSummonerApi',
                'getSummonersMasteriesBySummonerIds',
                [
                    [5]
                ]
            ],
            [
                'getSummonerApi',
                'getSummonersNamesBySummonerIds',
                [
                    [5]
                ]
            ],
            [
                'getSummonerApi',
                'getSummonersRunesBySummonerIds',
                [
                    [5]
                ]
            ],
        ];
    }
}
