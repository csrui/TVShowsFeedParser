<?php

namespace csrui\TVShowsFeedParser;

class Config
{
    private static $sFeedUrl = 'http://showrss.info/feeds/%s.rss';

    public static function feedUrl($sFeedUrl = null)
    {
        if (isset($sFeedUrl)) {
            return (bool)(self::$sFeedUrl = $sFeedUrl);
        }

        return self::$sFeedUrl;
    }
}