<?php

namespace SDK\Http;

use SDK\Http\ResponseCore;
use Exception;

class RequestCore{
    public $url;
    public $ch;
    public $type;

    public function __construct($url, $type){
        $this->url = $url;
        $this->type = $type;
        $this->ch = curl_init();
    }

    public function processRequest($data){
        curl_setopt($this->ch, CURLOPT_URL, $this->url);                //要访问的地址
        curl_setopt($this->ch, CURLOPT_HEADER, false);                  //是否显示返回的Header区域内容
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);           //获取的信息以文件流的形式返回
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);          //从证书中检查SSL加密算法是否存在
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);          //对认证证书来源的检查

        switch($this->type) {
            case 'get':
                break;
            case 'post':
                curl_setopt($this->ch, CURLOPT_POST, true);
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);      //设置请求体，提交数据包
                break;
            case 'put':
                $fields = http_build_query($data);
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($fields)));
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $fields);
                break;
            case 'delete':
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $response = curl_exec($this->ch);                               //执行操作
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);            //获取返回的状态码
        if($code == '200'){
            $response = new ResponseCore($response);
            return $response->getData();
        }else{
            $response = new ResponseCore($response);
            $message_array = $response->getData();
            throw new Exception($message_array['message']);
        }
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}