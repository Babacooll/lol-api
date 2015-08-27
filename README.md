## League of Legends API wrapper in PHP

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Babacooll/lol-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Babacooll/lol-api/build-status/master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/50170931-8848-4440-9e6c-37d9378986b9/mini.png)](https://insight.sensiolabs.com/projects/50170931-8848-4440-9e6c-37d9378986b9)
[![Latest Stable Version](https://poser.pugx.org/michaelgarrez/lol-api/v/stable)](https://packagist.org/packages/michaelgarrez/lol-api) 
[![Total Downloads](https://poser.pugx.org/michaelgarrez/lol-api/downloads)](https://packagist.org/packages/michaelgarrez/lol-api) 
[![Latest Unstable Version](https://poser.pugx.org/michaelgarrez/lol-api/v/unstable)](https://packagist.org/packages/michaelgarrez/lol-api) 
[![License](https://poser.pugx.org/michaelgarrez/lol-api/license)](https://packagist.org/packages/michaelgarrez/lol-api)

### Introduction

Simple PHP wrapper for [League of legends API](https://developer.riotgames.com/api/methods).

This library implements two custom exceptions to catch your API rate limits (ServiceRateLimitException && UserRateLimitException).

It also implements [Doctrine cache](https://github.com/doctrine/cache) to cache the API results into your favorite cache driver.

### Migration from 0.* to 1.*

Three main features breaking BC caused a bump to the 1.* version: 
* Cache implementation
* AbstractRateLimitException
* Return of an ApiResult object instead of an array

Only the third one can actually break BC. You should now use the **getResult()** method on the ApiResult object returned.

### How to use

#### Basic use

You first have to select the API you want to fetch from and then the specific method.
Each call will return an **ApiResult** object containing the URL called, the Guzzle Response object and an array containing the API result.

To get the result you can call the method **getResult()** on the ApiResult object.

```php
$apiClient = new \LoLApi\ApiClient(\LoLApi\ApiClient::REGION_EUW, 'my-key');

$apiClient->getMatchListApi()->getMatchListBySummonerId(2);
$apiClient->getMatchApi()->getMatchByMatchId(2, true);
$apiClient->getSummonerApi()->getSummonersBySummonerNames(['MySummonerName']);
$apiClient->getSummonerApi()->getSummonersBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersMasteriesBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersNamesBySummonerIds([2]);
$apiClient->getSummonerApi()->getSummonersRunesBySummonerIds([2]);
$apiClient->getChampionApi()->getChampionById(20);
$apiClient->getFeaturedGamesApi()->getFeaturedGames();
$apiClient->getStatsApi()->getRankedStatsBySummonerId(2);
$apiClient->getTeamApi()->getTeamsBySummonersIds([2]);
$apiClient->getTeamApi()->getTeamsByTeamsIds(['T1']);
$apiClient->getGameApi()->getRecentGamesBySummonerId(2);
$apiClient->getCurrentGameApi()->getCurrentGameByPlatformIdAndSummonerId('EUW1', 2);
```

#### Use cache

By default Doctrine's VoidCache provider is implemented. You can specify another Cache provider (implementing doctrine CacheProvider abstract class) to the ApiClient.

Example with Predis :

```php
$client = new \Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

$apiClient->setCacheProvider(new \Doctrine\Common\Cache\PredisCache($client));

// This will call the API and return to you an ApiResult object
$result = $apiClient->getSummonerApi()->getSummonersBySummonerNames(['MySummonerName']);

// Let's cache this result for 60 seconds into Redis
$apiClient->cacheApiResult($result, 60);

// This will fetch the data from Redis and return to you an ApiResult object
$result = $apiClient->getSummonerApi()->getSummonersBySummonerNames(['MySummonerName']);
```

The default ttl value **cacheApiResult()** method is 60 seconds.

#### Rate limit

When you reach the rate limit (User or Service) the library will throw you an implementation of the AbstractRateLimitException. You can get the type of rate limit and the time to wait before a new call (Riot is very strict on the rate limit respect).

Example with a sleep :

```php
$apiClient = new \LoLApi\ApiClient(\LoLApi\ApiClient::REGION_EUW, 'my-key');

for ($i = 0; $i < 100; $i++) {
    try {
        $apiClient->getMatchListApi()->getMatchListBySummonerId(2);
    } catch (AbstractRateLimitException $e) {
        sleep($e->getRetryAfter());
    }
}
```

### API implemented

| API        | Version           |
| ------------- |-------------| 
| [Summoner API](https://developer.riotgames.com/api/methods#)      | ![v1.4](https://img.shields.io/badge/v1.4-latest-green.svg)|  
| [MatchList API](https://developer.riotgames.com/api/methods#)      | ![v2.2](https://img.shields.io/badge/v2.2-latest-green.svg)|  
| [Match API](https://developer.riotgames.com/api/methods#)      | ![v2.2](https://img.shields.io/badge/v2.2-latest-green.svg)|  
| [Champion API](https://developer.riotgames.com/api/methods#)      | ![v1.2](https://img.shields.io/badge/v1.2-latest-green.svg)|  
| [Featured games API](https://developer.riotgames.com/api/methods#)      | ![v*.*](https://img.shields.io/badge/v*.*-latest-green.svg)|  
| [Stats API](https://developer.riotgames.com/api/methods#)     | ![v1.3](https://img.shields.io/badge/v1.3-latest-green.svg)|  
| [Team API](https://developer.riotgames.com/api/methods#)      | ![v2.4](https://img.shields.io/badge/v2.4-latest-green.svg)|  
| [Game API](https://developer.riotgames.com/api/methods#)      | ![v1.3](https://img.shields.io/badge/v1.3-latest-green.svg)|  
| [Current game API](https://developer.riotgames.com/api/methods#)      | ![v*.*](https://img.shields.io/badge/v*.*-latest-green.svg)|  


### TODO

* [League API](https://developer.riotgames.com/api/methods#!/985)
* [LoL static data API](https://developer.riotgames.com/api/methods#!/968)
* [LoL status API](https://developer.riotgames.com/api/methods#!/908)

### Contributing

Please create issues if you have any problem with this library integration.

If you want to contribute, create a PR, you must respect PSR-2 and your code must be tested.

Thank you !
