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

    public function processRequest($data, $filePath = ''){
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);

        switch($this->type) {
            case 'get':
                break;
            case 'post':
                if($filePath){
                    if(class_exists('\CURLFile')){
                        $data['file'] =  new \CURLFile($filePath);
                    }else{
                        $data['file'] = '@' . $filePath;
                    }
                    curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, true);
                    curl_setopt($this->ch, CURLOPT_INFILESIZE, filesize($filePath));
                }

                curl_setopt($this->ch, CURLOPT_POST, true);
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
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

        $response = curl_exec($this->ch);
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);            
        if($code == '200'){
            $response = new ResponseCore($response);
            return $response->getData();
        }else{
            $response = new ResponseCore($response);
            $message_array = $response->getData();
            throw new Exception($message_array['message']);
        }
    }

    public function __destruct(){
        curl_close($this->ch);
    }
}