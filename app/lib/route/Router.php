<?php
namespace app\lib\route;
class Router{
    private $key;
    private $object;
    private $func;
    private $name;
    private $method=array();
    private $type;

    function __set($key,$value){
        if(property_exists($this,$key)){
            $this->$key=$value;
        }
    }

    function __get($key){
        if(property_exists($this,$key)){
            return $this->$key;
        }
    }


}