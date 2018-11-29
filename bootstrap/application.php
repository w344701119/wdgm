<?php

 class application{
     private $application=array();
     private $request;
     private $response;


   //实例化一个app
   public static function run(){
       $app =new application();
       return $app;
    }
    //获取reques类
     public function GetRequest(){
         return $this->request;
     }
    //获取response类
     public function GetResponse(){
         return $this->response;
     }
     //添加
     public function SetApp($obj){
        if(is_object($obj)){
            $name=get_class($obj);
            $this->application[$name]=$obj;
        }
     }
    //返回列表
     public function GetAppList(){
         return $this->application;
     }







}