<?php
namespace app\lib\route;
class Route{
    static $route;


    public static function get($key, $route){
        self::$route=new Route();
        return self::$route;
    }

    public static function post($key,$route){
        self::$route=new Route();
        return self::$route;
    }

    public static function match($keys,$key,$route){
        self::$route=new Route();
        return self::$route;
    }



    public function name($name){
        self::$route->name=$name;
    }





}