<?php

namespace csrui\TVShowsFeedParser;

class Config
{
    private static $sFeedUrl = 'https://showrss.info/show/%s.rss';

    public static function feedUrl($sFeedUrl = null)
    {
        if (isset($sFeedUrl)) {
            return (bool)(self::$sFeedUrl = $sFeedUrl);
        }

        return self::$sFeedUrl;
    }
}