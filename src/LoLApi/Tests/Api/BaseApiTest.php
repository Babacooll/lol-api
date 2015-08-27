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
     * @covers LoLApi\Api\TeamApi
     * @covers LoLApi\Api\GameApi
     * @covers LoLApi\Api\CurrentGameApi
     * @covers LoLApi\Api\StatsApi
     */
    public function testAll($api, $method, array $options = [])
    {
        $api = $this->apiClient->{$api}();

        $this->assertSame(['success'], call_user_func_array([$api, $method], $options)->getResult());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return array_merge($this->getDataProvider1(), $this->getDataProvider2());
    }

    /**
     * @return array
     */
    protected function getDataProvider1()
    {
        return [
            [
                'getCurrentGameApi',
                'getCurrentGameByPlatformIdAndSummonerId',
                [
                    'EUW1',
                    5
                ]
            ],
            [
                'getGameApi',
                'getRecentGamesBySummonerId',
                [
                    5
                ]
            ],
            [
                'getStatsApi',
                'getRankedStatsBySummonerId',
                [
                    5
                ]
            ],
            [
                'getStatsApi',
                'getRankedSummaryBySummonerId',
                [
                    5
                ]
            ],
            [
                'getStatsApi',
                'getRankedStatsBySummonerId',
                [
                    5,
                    'SEASON2015'
                ]
            ],
            [
                'getStatsApi',
                'getRankedSummaryBySummonerId',
                [
                    5,
                    'SEASON2015'
                ]
            ],
            [
                'getTeamApi',
                'getTeamsBySummonersIds',
                [
                    [5]
                ]
            ],
            [
                'getTeamApi',
                'getTeamsByTeamsIds',
                [
                    [5]
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getDataProvider2()
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
            ]
        ];
    }
}
