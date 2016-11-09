<?php

namespace SDK\Model;

class Picture{
    public static $api_url = 'picture';
    public static $move_api_url = 'picture/move';

    static function getApiUrl($host, $token)
    {
       return $host . self::$api_url . '?token=' .$token;
    }

    static function getApiInfoUrl($id, $host, $token)
    {
        return $host . self::$api_url . '/' . $id . '?token=' .$token;
    }

    static function getMoveApiUrl($host, $token)
    {
        return $host . self::$move_api_url . '?token=' .$token;
    }
}