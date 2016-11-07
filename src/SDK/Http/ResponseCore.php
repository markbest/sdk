<?php

namespace SDK\Http;

class ResponseCore{
    private $data;

    public function __construct($json_data){
        $this->data = $json_data;
    }

    public function getData(){
        $data_array = json_decode($this->data, true);
        if(is_array($data_array)){
            return $data_array;
        }
    }
}