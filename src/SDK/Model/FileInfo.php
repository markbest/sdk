<?php

namespace SDK\Model;

class FileInfo{
    public static $api_url = 'fileInfo';

    static function getApiUrl($id, $host, $token)
    {
        return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}