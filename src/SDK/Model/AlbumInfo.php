<?php

namespace SDK\Model;

class AlbumInfo{
    public static $api_url = 'albumInfo';

    static function getApiUrl($id, $host, $token)
    {
       return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}