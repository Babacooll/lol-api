<?php

namespace LoLApi\Api;

use LoLApi\Result\ApiResult;

/**
 * Class StaticDataApi
 *
 * @package LoLApi\Api
 * @see     https://developer.riotgames.com/api-methods/
 */
class StaticDataApi extends BaseApi
{
    const API_URL_STATIC_DATA_CHAMPIONS = '/lol/static-data/v3/champions';
    const API_URL_STATIC_DATA_CHAMPION_BY_ID = '/lol/static-data/v3/champions/{id}';
    const API_URL_STATIC_DATA_ITEMS = '/lol/static-data/v3/items';
    const API_URL_STATIC_DATA_ITEM_BY_ID = '/lol/static-data/v3/items/{id}';
    const API_URL_STATIC_DATA_LANGUAGE_STRINGS = '/lol/static-data/v3/language-strings';
    const API_URL_STATIC_DATA_LANGUAGES = '/lol/static-data/v3/languages';
    const API_URL_STATIC_DATA_MAP = '/lol/static-data/v3/maps';
    const API_URL_STATIC_DATA_MASTERIES = '/lol/static-data/v3/masteries';
    const API_URL_STATIC_DATA_MASTERY_BY_ID = '/lol/static-data/v3/masteries/{id}';
    const API_URL_STATIC_DATA_REALM = '/lol/static-data/v3/realms';
    const API_URL_STATIC_DATA_RUNES = '/lol/static-data/v3/runes';
    const API_URL_STATIC_DATA_RUNE_BY_ID = '/lol/static-data/v3/runes/{id}';
    const API_URL_STATIC_DATA_SUMMONER_SPELLS = '/lol/static-data/v3/summoner-spells';
    const API_URL_STATIC_DATA_SUMMONER_SPELL_BY_ID = '/lol/static-data/v3/summoner-spells/{id}';
    const API_URL_STATIC_DATA_VERSIONS = '/lol/static-data/v3/versions';

    /**
     * @param string $locale
     * @param string $version
     * @param bool   $dataById
     * @param array  $champData
     *
     * @return ApiResult|null
     */
    public function getChampions($locale = null, $version = null, $dataById = false, array $champData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['dataById' => (string) $dataById, 'champData' => implode(',', $champData)]);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_CHAMPIONS, array_filter($queryParameters), true, true);
    }

    /**
     * @param int    $championId
     * @param string $locale
     * @param string $version
     * @param array  $champData
     *
     * @return ApiResult|null
     */
    public function getChampionById($championId, $locale = null, $version = null, array $champData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['champData' => implode(',', $champData)]);

        return $this->callApiUrl(str_replace('{id}', $championId, self::API_URL_STATIC_DATA_CHAMPION_BY_ID), array_filter($queryParameters), true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     *
     * @return ApiResult|null
     */
    public function getItems($locale = null, $version = null)
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_ITEMS, array_filter($queryParameters), true, true);
    }

    /**
     * @param int    $itemId
     * @param string $locale
     * @param string $version
     * @param array  $itemData
     *
     * @return ApiResult|null
     */
    public function getItemById($itemId, $locale = null, $version = null, array $itemData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['itemData' => implode(',', $itemData)]);

        return $this->callApiUrl(str_replace('{id}', $itemId, self::API_URL_STATIC_DATA_ITEM_BY_ID), array_filter($queryParameters), true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     *
     * @return ApiResult|null
     */
    public function getLanguageStrings($locale = null, $version = null)
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_LANGUAGE_STRINGS, array_filter($queryParameters), true, true);
    }

    /**
     * @return ApiResult|null
     */
    public function getLanguages()
    {
        return $this->callApiUrl(self::API_URL_STATIC_DATA_LANGUAGES, [], true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     *
     * @return ApiResult|null
     */
    public function getMap($locale = null, $version = null)
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_MAP, array_filter($queryParameters), true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     * @param array  $masteryListData
     *
     * @return ApiResult|null
     */
    public function getMasteries($locale = null, $version = null, array $masteryListData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['masteryListData' => implode(',', $masteryListData)]);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_MASTERIES, array_filter($queryParameters), true, true);
    }

    /**
     * @param int    $masteryId
     * @param string $locale
     * @param string $version
     * @param array  $masteryData
     *
     * @return ApiResult|null
     */
    public function getMasteryById($masteryId, $locale = null, $version = null, array $masteryData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['masteryData' => implode(',', $masteryData)]);

        return $this->callApiUrl(str_replace('{id}', $masteryId, self::API_URL_STATIC_DATA_MASTERY_BY_ID), array_filter($queryParameters), true, true);
    }

    /**
     * @return ApiResult|null
     */
    public function getRealms()
    {
        return $this->callApiUrl(self::API_URL_STATIC_DATA_REALM, [], true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     * @param array  $runeListData
     *
     * @return ApiResult|null
     */
    public function getRunes($locale = null, $version = null, array $runeListData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['runeListData' => implode(',', $runeListData)]);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_RUNES, array_filter($queryParameters), true, true);
    }

    /**
     * @param int    $runeId
     * @param string $locale
     * @param string $version
     * @param array  $runeData
     *
     * @return ApiResult|null
     */
    public function getRuneById($runeId, $locale = null, $version = null, array $runeData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['runeData' => implode(',', $runeData)]);

        return $this->callApiUrl(str_replace('{id}', $runeId, self::API_URL_STATIC_DATA_RUNE_BY_ID), array_filter($queryParameters), true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     * @param bool   $dataById
     * @param array  $spellData
     *
     * @return ApiResult|null
     */
    public function getSummonerSpells($locale = null, $version = null, $dataById = false, array $spellData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['dataById' => (string) $dataById, 'spellData' => implode(',', $spellData)]);

        return $this->callApiUrl(self::API_URL_STATIC_DATA_SUMMONER_SPELLS, array_filter($queryParameters), true, true);
    }

    /**
     * @param int    $summonerSpellId
     * @param string $locale
     * @param string $version
     * @param array  $spellData
     *
     * @return ApiResult|null
     */
    public function getSummonerSpellById($summonerSpellId, $locale = null, $version = null, array $spellData = [])
    {
        $queryParameters = $this->handleQueryParametersForLocaleAndVersion($locale, $version, ['spellData' => implode(',', $spellData)]);

        return $this->callApiUrl(str_replace('{id}', $summonerSpellId, self::API_URL_STATIC_DATA_SUMMONER_SPELL_BY_ID), array_filter($queryParameters), true, true);
    }

    /**
     * @return ApiResult|null
     */
    public function getVersions()
    {
        return $this->callApiUrl(self::API_URL_STATIC_DATA_VERSIONS, [], true, true);
    }

    /**
     * @param string $locale
     * @param string $version
     * @param array  $otherParameters
     *
     * @return array
     */
    protected function handleQueryParametersForLocaleAndVersion($locale = null, $version = null, $otherParameters = [])
    {
        $queryParameters = [];

        if ($locale !== null) {
            $queryParameters['locale'] = (string) $locale;
        }
        if ($version !== null) {
            $queryParameters['version'] = (string) $version;
        }

        return array_merge($queryParameters, $otherParameters);
    }
}
