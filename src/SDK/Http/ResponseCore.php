<?php

namespace SDK\Http;

class ResponseCore{
    private $data;

    public function __construct($json_data){
        $this->data = $json_data;
    }

    public function getData(){
        return json_decode($this->data, true);
    }
}