<?php
namespace humanity;

class ElasticSearchRequest {

    static private $url;
    static private $init;

    public function __construct($url){
        self::$init = curl_init($url);
        curl_setopt_array(self::$init,[
            CURLOPT_AUTOREFERER=>true,
            CURLOPT_FOLLOWLOCATION=>true,
            CURLOPT_HEADER=>false,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_VERBOSE=>false,
            CURLOPT_CONNECTTIMEOUT=>3,
            CURLOPT_TIMEOUT=>3
        ]);
    }

    public function __destruct(){
        curl_close(self::$init);
    }

    public function delete(){
        curl_setopt(self::$init, CURLOPT_CUSTOMREQUEST, 'DELETE');
        return json_decode(curl_exec(self::$init),true);
    }

    public function put($params){
        if(is_array($params)) $params = json_encode($params);
        curl_setopt(self::$init, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt(self::$init, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($params)));
        curl_setopt(self::$init,CURLOPT_POSTFIELDS,$params);
        return json_decode(curl_exec(self::$init),true);
    }

    public function post($params){
        if(is_array($params)) $params = json_encode($params);
        curl_setopt(self::$init, CURLOPT_POST,true);
        curl_setopt(self::$init, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($params)));
        curl_setopt(self::$init,CURLOPT_POSTFIELDS,$params);
        return json_decode(curl_exec(self::$init),true);
    }

    public function get(){
        return json_decode(curl_exec(self::$init),true);
    }

    public function head(){
        curl_setopt(self::$init, CURLOPT_HEADER, true);
        curl_setopt(self::$init, CURLOPT_CUSTOMREQUEST, 'HEAD');
        return json_decode(curl_exec(self::$init),true);
    }

}

?>
