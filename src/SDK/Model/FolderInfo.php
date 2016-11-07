<?php

namespace SDK\Model;

class FolderInfo{
    public static $api_url = 'folderInfo';

    static function getApiUrl($id, $host, $token)
    {
        return  $host . self::$api_url . '/' . $id . '?token=' .$token;
    }
}