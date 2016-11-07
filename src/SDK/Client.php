<?php

namespace SDK;

use SDK\Http\RequestCore;
use SDK\Model\Auth;
use SDK\Model\AlbumList;
use SDK\Model\AlbumInfo;
use SDK\Model\PictureList;
use SDK\Model\PictureInfo;
use SDK\Model\FolderList;
use SDK\Model\FolderInfo;
use SDK\Model\FileList;
use SDK\Model\FileInfo;

class Client{
    private $host;
    private $email;
    private $password;
    private $token;

    /**
     * 构造函数
     *
     * 初始化使用 $Client = new Client($host, $email, $password)
     *
     */
    public function __construct($host, $email, $password)
    {
        $this->host = trim($host);
        $this->email = trim($email);
        $this->password = trim($password);

        self::checkEnv();
        self::auth();
    }

    /**
     * 用来检查SDK所以来的扩展是否打开
     *
     * @throws OssException
     */
    public static function checkEnv()
    {
        if(function_exists('get_loaded_extensions')){
            //检测curl扩展
            $enabled_extension = array("curl");
            $extensions = get_loaded_extensions();
            if($extensions){
                foreach($enabled_extension as $item){
                    if(!in_array($item, $extensions)){
                        throw new Exception("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
                    }
                }
            }else{
                throw new Exception("function get_loaded_extensions not found.");
            }
        }else{
            throw new Exception('Function get_loaded_extensions has been disabled, please check php config.');
        }
    }

    /**
     * api登录验证，获取token
     */
    public function auth()
    {
        $url = Auth::getApiUrl($this->host);
        $data = array('email' => $this->email, 'password' => $this->password);

        $request = new RequestCore($url);
        $response_data = $request->send($data);
        $this->token = $response_data['token'] ? $response_data['token'] : '';
    }

    /**
     * 获取所有相册的列表
     */
    public function listAlbums()
    {
        $url = AlbumList::getApiUrl($this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取相册id的详细信息
     */
    public function infoAlbum($id)
    {
        $url = AlbumInfo::getApiUrl($id, $this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取所有图片的列表
     */
    public function listPictures()
    {
        $url = PictureList::getApiUrl($this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取图片id的详细信息
     */
    public function infoPicture($id)
    {
        $url = PictureInfo::getApiUrl($id, $this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取所有文件夹的列表
     */
    public function listFolders()
    {
        $url = FolderList::getApiUrl($this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取文件夹id的详细信息
     */
    public function infoFolder($id)
    {
        $url = FolderInfo::getApiUrl($id, $this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取所有文件的列表
     */
    public function listFiles()
    {
        $url = FileList::getApiUrl($this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }

    /**
     * 获取文件id的详细信息
     */
    public function infoFile($id)
    {
        $url = FileInfo::getApiUrl($id, $this->host, $this->token);

        $request = new RequestCore($url, 'get');
        $response_data = $request->send();
        return $response_data;
    }
}