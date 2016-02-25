<?php
namespace humanity;

class ElasticSearchRaw {
    static private $host = '';
    static private $port = '';

    public function __construct($host,$port){
        self::$host = $host;
        self::$port = $port;
    }

    public function index($index=false){
        if($index !== false){
            $index = explode('/',$index);        
            foreach($index as $key=>$value){
                $value = trim($value);
                if(empty($value)) unset($index[$key]);
            }
            $index = implode('/',$index);
            return new ElasticSearchRequest('http://'.self::$host.':'.self::$port.'/'.$index);
        } else {
            return new ElasticSearchRequest('http://'.self::$host.':'.self::$port);
        }
    }
}
?>
