<?php

namespace SDK\Model;

class FileList{
    public static $api_url = 'filesList';

    static function getApiUrl($host, $token)
    {
       return  $host . self::$api_url . '?token=' .$token;
    }
}