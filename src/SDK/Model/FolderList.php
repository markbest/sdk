<?php

namespace SDK\Model;

class FolderList{
    public static $api_url = 'foldersList';

    static function getApiUrl($host, $token)
    {
       return  $host . self::$api_url . '?token=' .$token;
    }
}