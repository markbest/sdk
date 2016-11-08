<?php

namespace SDK\Model;

class Picture{
    public static $api_url = 'picture';

    static function getApiUrl($host, $token)
    {
       return  $host . self::$api_url . '?token=' .$token;
    }

    static function getApiInfoUrl($id, $host, $token)
    {
        return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}