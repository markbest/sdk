<?php

namespace SDK\Model;

class PictureInfo{
    public static $api_url = 'pictureInfo';

    static function getApiUrl($id, $host, $token)
    {
       return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}