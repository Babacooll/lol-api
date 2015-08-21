## League of Legends API wrapper in PHP

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/build-status/master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/50170931-8848-4440-9e6c-37d9378986b9/mini.png)](https://insight.sensiolabs.com/projects/50170931-8848-4440-9e6c-37d9378986b9)

### Introduction

Simple PHP wrapper for [League of legends API](https://developer.riotgames.com/api/methods)

### How to use

Example of use :

```php
$apiClient = new \LoLApi\ApiClient(\LoLApi\ApiClient::REGION_EUW, 'my-key');

$apiClient->getMatchListApi()->getMatchListBySummonerId(2);
$apiClient->getMatchApi()->getMatchByMatchId(2, true);
$apiClient->getSummonerApi()->getSummonersBySummonerNames(['MySummonerName']);
$apiClient->getSummonerApi()->getSummonersBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersMasteriesBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersNamesBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersRunesBySummonerIds([2]);
```

### Methods implemented

* [Summoner API](https://developer.riotgames.com/api/methods#!/1017)
* [MatchList API](https://developer.riotgames.com/api/methods#!/1013)
* [Match API](https://developer.riotgames.com/api/methods#!/1014)

### TODO

Other API's
