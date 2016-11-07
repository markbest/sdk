<?php

namespace SDK\Model;

class AlbumList{
    public static $api_url = 'albumsList';

    static function getApiUrl($host, $token)
    {
       return  $host . self::$api_url . '?token=' .$token;
    }
}