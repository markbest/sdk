<?php

namespace SDK\Http;

use SDK\Http\ResponseCore;

class RequestCore{
    public $url;
    public $ch = null;
    private $type = 1;

    public function __construct($url, $type = 'post'){
        $this->url = $url;
        $this->ch = curl_init();
        $this->type = $type;
    }

    public function send($param = ''){
        if('post' == $this->type){
            $result = $this->posts($param);
        }else{
            $result = $this->gets($param);
        }
        $response = new ResponseCore($result);
        return $response->getData();
    }

    public function posts($post_data){
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec( $this->ch );
        return $output;
    }

    public function gets(){
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        $output = curl_exec($this->ch);
        return $output;
    }
}