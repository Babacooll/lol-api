<?php

namespace LoLApi\Tests\Api;

use Doctrine\Common\Cache\VoidCache;
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
     * @covers       LoLApi\Api\BaseApi
     * @covers       LoLApi\Api\ChampionApi
     * @covers       LoLApi\Api\FeaturedGamesApi
     * @covers       LoLApi\Api\MatchApi
     * @covers       LoLApi\Api\MatchListApi
     * @covers       LoLApi\Api\SummonerApi
     * @covers       LoLApi\Api\TeamApi
     * @covers       LoLApi\Api\GameApi
     * @covers       LoLApi\Api\CurrentGameApi
     * @covers       LoLApi\Api\StatsApi
     * @covers       LoLApi\Api\StaticDataApi
     * @covers       LoLApi\Api\LeagueApi
     * @covers       LoLApi\Api\StatusApi
     * @covers       LoLApi\Api\ChampionMasteryApi
     */
    public function testAll($api, $method, array $options = [])
    {
        $api = $this->apiClient->{$api}();

        $this->assertSame(['success'], call_user_func_array([$api, $method], $options)->getResult());
    }

    /**
     * @covers LoLApi\Api\BaseApi::callApiUrl
     */
    public function testWithCachedResult()
    {
        $arrayCache = $this->getMockBuilder('Doctrine\Common\Cache\ArrayCache')->disableOriginalConstructor()->getMock();
        $arrayCache->expects($this->once())->method('contains')->willReturn(true);
        $arrayCache->expects($this->once())->method('fetch')->willReturn('{}');

        $apiClient = $this->getApiClient($arrayCache, $this->getSuccessfulHttpClient());

        $apiClient->getCurrentGameApi()->getCurrentGameByPlatformIdAndSummonerId('EUW1', 5);
    }

    /**
     * @covers LoLApi\Api\BaseApi::callApiUrl
     *
     * @expectedException \LoLApi\Exception\ServiceRateLimitException
     */
    public function testWithRateLimitException()
    {
        $apiClient = $this->getApiClient(new VoidCache(), $this->getRateLimitHttpClient());

        $apiClient->getCurrentGameApi()->getCurrentGameByPlatformIdAndSummonerId('EUW1', 5);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return array_merge($this->getDataProvider1(), $this->getDataProvider2(), $this->getDataProvider3(), $this->getDataProvider4(), $this->getDataProvider5(), $this->getDataProvider6());
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
                'getSummonerBySummonerName',
                [
                    'test'
                ]
            ],
            [
                'getSummonerApi',
                'getSummonerBySummonerId',
                [
                    5
                ]
            ],
            [
                'getSummonerApi',
                'getSummonerByAccountId',
                [
                    5
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getDataProvider3()
    {
        return [
            [
                'getStaticDataApi',
                'getChampions',
            ],
            [
                'getStaticDataApi',
                'getChampionById',
                [
                    5
                ]
            ],
            [
                'getStaticDataApi',
                'getChampionById',
                [
                    5
                ]
            ],
            [
                'getStaticDataApi',
                'getItems'
            ],
            [
                'getStaticDataApi',
                'getItemById',
                [
                    5
                ]
            ],
            [
                'getStaticDataApi',
                'getLanguageStrings'
            ],
            [
                'getStaticDataApi',
                'getLanguages'
            ],
            [
                'getStaticDataApi',
                'getMap'
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getDataProvider4()
    {
        return [
            [
                'getStaticDataApi',
                'getMasteries'
            ],
            [
                'getStaticDataApi',
                'getMasteryById',
                [
                    5
                ]
            ],
            [
                'getStaticDataApi',
                'getRealms'
            ],
            [
                'getStaticDataApi',
                'getRunes'
            ],
            [
                'getStaticDataApi',
                'getRuneById',
                [
                    5,
                    'fr',
                    'v1.2'
                ]
            ],
            [
                'getStaticDataApi',
                'getVersions'
            ],
            [
                'getStaticDataApi',
                'getSummonerSpells'
            ],
            [
                'getStaticDataApi',
                'getSummonerSpellById',
                [
                    5
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getDataProvider5()
    {
        return [
            [
                'getLeagueApi',
                'getLeagueBySummonersIds',
                [
                    [
                        5
                    ]
                ]
            ],
            [
                'getLeagueApi',
                'getLeagueEntriesBySummonersIds',
                [
                    [
                        5
                    ]
                ]
            ],
            [
                'getLeagueApi',
                'getChallengerLeagues',
                [
                    'RANKED_SOLO_5x5'
                ]
            ],
            [
                'getLeagueApi',
                'getMasterLeagues',
                [
                    'RANKED_SOLO_5x5'
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getDataProvider6()
    {
        return [
            [
                'getStatusApi',
                'getShards'
            ],
            [
                'getStatusApi',
                'getShardsByRegion',
                [
                    'euw'
                ]
            ],
            [
                'getChampionMasteryApi',
                'getChampionMastery',
                [
                    'EUW1',
                    5,
                    5
                ]
            ],
            [
                'getChampionMasteryApi',
                'getChampionsMasteries',
                [
                    'EUW1',
                    5
                ]
            ],
            [
                'getChampionMasteryApi',
                'getChampionsMasteriesScore',
                [
                    'EUW1',
                    5
                ]
            ],
            [
                'getChampionMasteryApi',
                'getTopChampionsMasteries',
                [
                    'EUW1',
                    5,
                    4
                ]
            ]
        ];
    }
}
