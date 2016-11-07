<?php

namespace SDK\Model;

class PictureList{
    public static $api_url = 'picturesList';

    static function getApiUrl($host, $token)
    {
       return  $host . self::$api_url . '?token=' .$token;
    }
}