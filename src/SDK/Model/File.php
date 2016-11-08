<?php

namespace SDK\Model;

class File{
    public static $api_url = 'file';

    static function getApiUrl($host, $token)
    {
        return  $host . self::$api_url . '?token=' .$token;
    }

    static function getApiInfoUrl($id, $host, $token)
    {
        return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}