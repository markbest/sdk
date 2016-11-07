<?php

namespace SDK\Model;

class Auth{
    public static $api_url = 'authenticate';

    static function getApiUrl($host)
    {
        return  $host . self::$api_url;
    }
}