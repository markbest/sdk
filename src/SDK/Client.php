<?php

namespace SDK;

use SDK\Http\RequestCore;
use SDK\Model\Auth;
use SDK\Model\Album;
use SDK\Model\Picture;
use SDK\Model\Folder;
use SDK\Model\File;
use Exception;

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
     * 用来检查SDK所用的扩展是否打开
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

        $request = new RequestCore($url, 'post');
        $response_data = $request->processRequest($data);
        $this->token = $response_data['token'] ? $response_data['token'] : '';
    }

    /**
     * 获取所有相册的列表
     */
    public function listAlbums()
    {
        $url = Album::getApiUrl($this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 增加新相册
     */
    public function addAlbum($name, $description)
    {
        $url = Album::getApiUrl($this->host, $this->token);
        $data = array('name' => $name, 'description' => $description);

        $request = new RequestCore($url, 'post');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取相册id的详细信息
     */
    public function infoAlbum($id)
    {
        $url = Album::getApiInfoUrl($id, $this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 更改相册信息
     */
    public function updateAlbum($id, $name, $description)
    {
        $url = Album::getApiInfoUrl($id, $this->host, $this->token);
        $data = array('name' => $name, 'description' => $description);

        $request = new RequestCore($url, 'put');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 删除指定的相册
     */
    public function deleteAlbum($id)
    {
        $url = Album::getApiInfoUrl($id, $this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'delete');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取所有图片的列表
     */
    public function listPictures()
    {
        $url = Picture::getApiUrl($this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取图片id的详细信息
     */
    public function infoPicture($id)
    {
        $url = Picture::getApiInfoUrl($id, $this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取所有文件夹的列表
     */
    public function listFolders()
    {
        $url = Folder::getApiUrl($this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取文件夹id的详细信息
     */
    public function infoFolder($id)
    {
        $url = Folder::getApiInfoUrl($id, $this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取所有文件的列表
     */
    public function listFiles()
    {
        $url = File::getApiUrl($this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }

    /**
     * 获取文件id的详细信息
     */
    public function infoFile($id)
    {
        $url = File::getApiInfoUrl($id, $this->host, $this->token);
        $data = array();

        $request = new RequestCore($url, 'get');
        $response_data = $request->processRequest($data);
        return $response_data;
    }
}